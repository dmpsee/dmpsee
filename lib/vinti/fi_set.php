<?php

// Naranza Vinti - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function vinti_fi_set(string $folder, string $file, string $data): vinti_command
{
  $command = new vinti_command();
  $command->cmd = 'fi-set';
  $command->folder = $folder;
  $command->file = $file;
  $command->data = $data;
  return $command;
}
