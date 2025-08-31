<?php

// Naranza Vinti - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

function vinti_fi_lst(string $folder): vinti_command
{
  $command = new vinti_command();
  $command->cmd = 'fi-lst';
  $command->folder = $folder;
  return $command;
}
