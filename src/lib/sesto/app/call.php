<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

require_once SESTO_DIR . '/core/exit.php';

function sesto_app_call(callable $callback, array $args = [], callable $error_handler = null, string &$error = ''): int
{
  $exit_code = 0;
  $error = '';
  try {
    if ([] === $args) {
      $callback($args);
    } else {
      $callback(...$args);
    }
  } catch (sesto_exit $throwable) {
    /* do nothing */
  } catch (throwable $throwable) {
    /* check if output buffer is started */
    if (ob_get_length() > 0) {
      ob_clean();
      ob_end_clean();
    }
    if (null !== $error_handler) {
      call_user_func_array($error_handler, [$throwable, $args]);
    }
    $exit_code = 1;
    $error = $throwable->getmessage();
  }
  return $exit_code;
}
