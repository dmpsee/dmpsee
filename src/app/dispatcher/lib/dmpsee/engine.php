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
require_once VINTI_DIR . '/fi_ren.php';
require_once VINTI_DIR . '/exec.php';
require_once DMPSEE_DIR . '/subscriber/url_read.php';
require_once DMPSEE_DIR . '/event/subscribers.php';
require_once DMPSEE_DIR . '/curl/post.php';

function dmpseee_dispatcher_engine(array $config, array $args = []): void
{

  /* log */
  // openlog("estro", $config['log_flags'] ?? LOG_PID, LOG_LOCAL0);
  // sesto_syslog('__set', $config['log_priority'] ?? LOG_INFO);

  echo "hello I am " . __FUNCTION__  . "\n";
  $to_process = [];
  $vinti_client = sesto_resource('vinti');

  sesto_d($vinti_client, '$vinti_client');

  $events_result = vinti_exec($vinti_client, vinti_fi_lst('queue/new'));
  // sesto_d($events_result, '$events_result');

  if ($events_result->code === SESTO_HTTP_OK) {
    $num_files = count($events_result->files);
    echo sprintf("Events %d\n", $num_files);

    /* queue: rename events */
    foreach($events_result->files as $event_id) {
      echo sprintf("Read event id %s\n", $event_id);
      $move_result = vinti_exec($vinti_client, vinti_fi_ren('queue/new', $event_id, 'queue/active'));
      if ($move_result->error === '') {
        echo sprintf('Active %s', $event_id);
        $to_process[] = $event_id;
      } else {
        echo sprintf('Error %s Unable to move', $event_id);
      }
    }

    /* queue: process active events */
    $event_subscribers = [];
    $subscriber_urls = [];
    foreach($to_process as $event_id) {
      echo sprintf("Read %s\n", $event_id);
      $event_result = vinti_exec($vinti_client, vinti_fi_get('queue/active', $event_id));
      if ($event_result->error === '') {
        // sesto_d($event_result, 'event_result');
        $event = json_decode($event_result->message, true);
        // sesto_d($event, 'event');
        if (is_array($event)) {
          if (!isset($event_subscribers[$event['event']])) {
            $event_subscribers[$event['event']] = dmpseee_event_subscribers($vinti_client, $event['event']);
          }
          foreach($event_subscribers[$event['event']] as $subscriber_id) {
            if (!isset($subscriber_urls[$subscriber_id])) {
              $subscriber_urls[$subscriber_id] = dmpseee_subscriber_url_read($vinti_client, $subscriber_id);
            }
            $post_result = dmpsee_curl_post(
              $subscriber_urls[$subscriber_id],
              $event_result->message,
              $config['subscriber_post'] ?? []);
            echo sprintf("Post %s %d %s \n", $event_id, $post_result->status_code, $subscriber_id);
          }
        } else {
          echo sprintf('Unable decode event %s', $event_id);
        }
      } else {
        echo $event_result->error;
      }
      // sesto_d($event_subscribers, '$event_subscribers');
      // sesto_d($subscriber_urls, '$subscriber_urls');
      // sesto_d($config, '$config');

    //     echo sprintf("Processing file %s\n", $event_id);
    //     /* subscribers */
    //     $subscribers_result = vinti_exec($vinti_client, vinti_fi_lst('event/' . $event['event'] . '/subscriber'));
    //     $subscribers = $subscribers_result->files;
    //     // sesto_d($subscribers, '$subscribers');
    //     foreach($subscribers as $subscriber_id) {
    //       /* subscriber */
    //       $subscriber_result = vinti_exec($vinti_client, vinti_fi_get('subscriber/' . $subscriber_id, 'url'));
    //       $subscriber = json_decode($subscriber_result->message, true);
    //       // sesto_d($subscriber, '$subscriber');
    //       echo sprintf("Ping subscriber %s with url %s\n", $subscriber_id, $subscriber['url']);
    //     }
  }
    sesto_d($to_process, '$to_process');
  } else {
    $error = 'Vinti error';
  }


  $exit = false;
  // while (!$exit) {

  // }
}
