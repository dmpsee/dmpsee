<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

class sesto_condition implements JsonSerializable
{

  public string $param;
  public string $condition;
  public mixed $value;

  public function __construct(string $param, string $condition, mixed $value)
  {
    $this->param = $param;
    $this->condition = $condition;
    $this->value = $value;
  }

  public function encode(): array
  {
    return [
      'param' => $this->param,
      'condition' => $this->condition,
      'value' => $this->value];
  }

  public function decode(array $data): void
  {
    $this->param = $data['param'];
    $this->condition = $data['condition'];
    $this->value = $data['value'];
  }

  public function __serialize(): array
  {
    return $this->encode();
  }

  public function __unserialize(array $data): void
  {
    $this->decode($data);
  }

  public function jsonSerialize(): mixed
  {
    return $this->encode();
  }

}
