<?php

// DMPsee - https://dmpsee.org
// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright Digital Curation Centre (UK) and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/log/syslog.php';
require_once SESTO_DIR . '/http/status_codes.php';
require_once VINTI_DIR . '/exec.php';
require_once VINTI_DIR . '/fi_lst.php';
require_once VINTI_DIR . '/fi_get.php';
require_once VINTI_DIR . '/exec.php';

function dmpseee_dispatcher_engine(array $config, array $args = []): void
{

  /* log */
  // openlog("estro", $config['log_flags'] ?? LOG_PID, LOG_LOCAL0);
  // sesto_syslog('__set', $config['log_priority'] ?? LOG_INFO);

  echo "hello I am " . __FUNCTION__  . "\n";

  $vinti_client = sesto_resource('vinti');

  // sesto_d($vinti_client, '$vinti_client');

  $files_result = vinti_exec($vinti_client, vinti_fi_lst('queue/new'));
  // sesto_d($files_result, '$files_result');

  if ($files_result->code !== SESTO_HTTP_OK) {
    $error = 'Vinti error';
  } else {
    /* events */
    $files = $files_result->files;
    $num_files = count($files);
    echo sprintf("Found %d events\n", $num_files);

    foreach($files as $file) {
      $event_result = vinti_exec($vinti_client, vinti_fi_get('queue/new', $file));
      // sesto_d($event_result, 'event_result');
      $event = json_decode($event_result->message, true);
      // sesto_d($event, 'event');
      if (is_array($event)) {
        echo sprintf("Processing file %s\n", $file);
        /* subscribers */
        $subscribers_result = vinti_exec($vinti_client, vinti_fi_lst('event/' . $event['event'] . '/subscriber'));
        $subscribers = $subscribers_result->files;
        // sesto_d($subscribers, '$subscribers');
        foreach($subscribers as $subscriber_id) {
          /* subscriber */
          $subscriber_result = vinti_exec($vinti_client, vinti_fi_get('subscriber/' . $subscriber_id, 'url'));
          $subscriber = json_decode($subscriber_result->message, true);
          // sesto_d($subscriber, '$subscriber');
          echo sprintf("Ping subscriber %s with url %s\n", $subscriber_id, $subscriber['url']);
        }
      }
    }
  }


  $exit = false;
  // while (!$exit) {

  // }
}
