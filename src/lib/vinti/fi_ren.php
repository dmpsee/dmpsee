<?php

// Naranza Vinti - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function vinti_fi_ren(string $folder, string $file, string $to): vinti_command
{
  $command = new vinti_command();
  $command->cmd = 'fi-ren';
  $command->folder = $folder;
  $command->file = $file;
  $command->to = $to;
  return $command;
}
