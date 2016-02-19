<?php
include_once(__DIR__."/ConnectionDetails.php");
class RestDBM{
      private $conn;
      private $pdoCon;

      public function __construct($dbToConnectTo){
        // Create connection
        $connectionDetails = ConnectionDetails::getConnectionDetails($dbToConnectTo);
        try{
          $this->pdoCon = new PDO("mysql:host={$connectionDetails['server']};dbname={$connectionDetails['db']};charset=utf8", $connectionDetails['username'], $connectionDetails['password']);
        } catch(exception $e){
                die("Connection failed: " . $e->getMessage());
        }
      }

      public function closeConnection(){
        $this->pdoCon = null;
      }


      public function prepareStatment($sql, $params){
              if ($stmt = $this->pdoCon->prepare($sql)) {
          $stmt->execute($params);
                      return $stmt;
              }
      }

      public function runSQLFile($sqlFile){
        $sqlQuery = file_get_contents($sqlFile);
        $this->pdoCon->exec($sqlQuery);
      }

      public function getLastInsertedId(){
        return $this->pdoCon->lastInsertId();
      }

      public function sql($sql){
              try {
                      $result = $this->conn->query($sql);
              } catch(exception $e){
                      throw new SQLException("Error: {$this->conn->error} SQL: {$sql}");
              }
              return $result;
      }
}
