<?php
namespace classes;
class DatabaseTable {
	private $pdo;
	private $table;
	private $primaryKey;
	private $entityClass;
	private $entityConstructor;
	

	public function __construct($pdo, $table, $primaryKey, $entityClass = '\stdclass', $entityConstructor = []) {
		$this->pdo = $pdo;
		$this->table = $table;
		$this->primaryKey = $primaryKey;
		$this->entityClass = $entityClass;
        $this->entityConstructor = $entityConstructor;
	}

	public function find($field, $value) {
		$stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');

		$criteria = [
			'value' => $value
		];
		$stmt->execute($criteria);

		return $stmt->fetchAll();
	}


	public function findAll() {
		$stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table);
		$stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);

		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function insert($record) {
	        $keys = array_keys($record);

	        $values = implode(', ', $keys);
	        $valuesWithColon = implode(', :', $keys);

	        $query = 'INSERT INTO ' . $this->table . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';

	        $stmt = $this->pdo->prepare($query);

	        $stmt->execute($record);
	}

	public function delete($id) {
		$stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' = :id');
		$criteria = [
			'id' => $id
		];
		$stmt->execute($criteria);
	}


	public function save($record) {
		try {
			$this->insert($record);
		}
		catch (Exception $e) {
			$this->update($record);
		}
	}

	public function update($record) {

	         $query = 'UPDATE ' . $this->table . ' SET ';

	         $parameters = [];
	         foreach ($record as $key => $value) {
	                $parameters[] = $key . ' = :' .$key;
	         }

	         $query .= implode(', ', $parameters);
	         $query .= ' WHERE ' . $this->primaryKey . ' = :primaryKey';

	         $record['primaryKey'] = $record[$this->primaryKey];

	         $stmt = $this->pdo->prepare($query);

	         $stmt->execute($record);
	}

}
