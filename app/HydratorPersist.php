<?php

namespace Peteno;


trait HydratorPersist {

    private function getProperties() {
        return get_class_vars(__CLASS__);
    }

    private function getObjectVars() {
        return get_object_vars($this);
    }

    public function hydrate(array $data) {
        $entityProperties = $this->getProperties();
        foreach ($data as $key => $value) {
            if (!in_array($key, array_keys($entityProperties))) {
                continue;
            }
            $setter = sprintf('set%s', ucfirst($key));
            if (method_exists($this, $setter)) {
                $this->{$setter}($value);
            }
        }
    }

    private function hydateParamsSQL(array $dataInsert) {
      return array_combine(
        array_map(function($k) {
          return ':'.$k;
        }, array_keys($dataInsert)),
        array_map(function($k) {
            if (is_string($k)) {
                $k = addslashes($k);
            }
            return $k;
        }, array_values($dataInsert))
      );
    }

    private function insertOrUpdate(\PDO $conn) {
      $tableName = (new \ReflectionClass($this))->getShortName();
      $dataChanged = $this->getObjectVars();
      $dataChangeParams = $this->hydateParamsSQL($dataChanged);

      $sqlData = null;
      if ($dataChanged[$this->getPrimaryKeyName()] === null) {
        $sqlData = sprintf('insert into %s (%s) values (%s);',
            $tableName,
            implode(', ', array_keys($dataChanged)),
            implode(', ', array_keys($dataChangeParams)));
      } else {
        $sqlData = sprintf('update %s set %s where %3$s = :%3$s',
            $tableName,
            implode(', ', array_map(function($k) {
                          return $k .' = :'.$k;
                        }, array_keys($dataChanged))),
            $this->getPrimaryKeyName()
            );
      }

      $st = $conn->prepare($sqlData);

      foreach ($dataChangeParams as $key => $value) {
        if (!$st->bindValue($key, $value)) {
          throw new \Exception('Erro ao atribuir o valor: ' . $key . '=>' . $value);
        }
      }
      $st->execute();

      if ($st->errorCode() <> '00000') {
        throw new \Exception($st->errorInfo()[2]);
      }
    }

    public function save(\PDO $conn) {
      $this->insertOrUpdate($conn);
    }

    abstract function getPrimaryKeyName();
}
