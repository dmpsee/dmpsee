<?php

// Naranza Vinti - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

class vinti_command
{
  public string $cmd = '';
  public string $folder = '';
  public string $data = '';
  public string $file = '';
  public string $to = '';


  public function __toString(): string
  {
    switch ($this->cmd) {
      case 'da-ins':
        $out = json_encode(['cmd' => $this->cmd, 'folder' => $this->folder, 'data' => $this->data]) ?: '';
        break;
      case 'fi-set':
        $out = json_encode(['cmd' => $this->cmd, 'folder' => $this->folder, 'file' => $this->file, 'data' => $this->data]) ?: '';
        break;
      case 'fi-get':
        $out = json_encode(['cmd' => $this->cmd, 'folder' => $this->folder, 'file' => $this->file]) ?: '';
        break;
      case 'fi-ren':
        $out = json_encode(['cmd' => $this->cmd, 'folder' => $this->folder, 'file' => $this->file, 'to' => $this->to]) ?: '';
        break;
      case 'fi-lst':
        $out = json_encode(['cmd' => $this->cmd, 'folder' => $this->folder]) ?: '';
        break;
      default:
        $out = '';
    }
    return $out;
  }
}

// -d '{
//     "cmd": "da-ins",
//     "folder": "test/new",
//     "data": "this is a string of data I want to add"
// }'

// function fo_ins(vinti_client $client, string $folder): void;

// function da_ins(vinti_client $client, string $folder, string $data): void;

// function fi_lst(vinti_client $client, string $folder): array;

// function fi_get(vinti_client $client, string $folder, string $file): string;

// function fi_set(vinti_client $client, string $folder, string $file, string $data): void;

// function fi_del(vinti_client $client, string $folder, string $file): void;

// function fi_ren(vinti_client $client, string $folder, string $file, string $to): void;