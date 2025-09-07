<?php

// Naranza Vinti - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function vinti_da_ins(string $folder, string $data): vinti_command
{
  $command = new vinti_command();
  $command->cmd = 'da-ins';
  $command->folder = $folder;
  $command->data = $data;
  return $command;
}
