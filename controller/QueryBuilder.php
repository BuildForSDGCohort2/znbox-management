<?php

namespace controller;

use connections\Database;

class QueryBuilder {

	public static function insert($table, $data) {
		$conn = Database::conn();
		$sql = "INSERT INTO $table(";
		foreach($data as $key => $value) {
			$key = rtrim(ltrim($conn->quote($key), "'"), "'");
			$sql .= "$key, ";
		}
		$sql = rtrim($sql, ", ").") VALUES(";
		foreach($data as $key => $value) {
			$value = (!$value || is_numeric($value)) ? ((gettype($value) == "NULL") ? "NULL" : (($value == "") ? $conn->quote($value) : $value)) : $conn->quote($value);
			$sql .= "$value, ";
		}
		$sql = rtrim($sql, ", ").");";
		return $sql;
	}
	public static function update($table, $column, $id, $data) {
		$conn = Database::conn();
		$sql = "UPDATE $table SET ";
		foreach($data as $key => $value) {
			$key = rtrim(ltrim($conn->quote($key), "'"), "'");
			$value = (!$value || is_numeric($value)) ? ((gettype($value) == "NULL") ? "NULL" : (($value == "") ? $conn->quote($value) : $value)) : $conn->quote($value);
			$sql .= "$table.$key = $value, ";
		}
		$sql = rtrim($sql, ", ");
		$sql = $sql." WHERE $table.$column = $id;";
		return $sql;
	}
	public static function update_where($table, $data, $where) {
		$conn = Database::conn();
		$sql = "UPDATE $table SET ";
		foreach($data as $key => $value) {
			$key = rtrim(ltrim($conn->quote($key), "'"), "'");
			$value = $conn->quote($value);
			$sql .= "$table.$key = $value, ";
		}
		$sql = rtrim($sql, ", ");
		$sql = $sql." $where;";
		return $sql;
	}
}