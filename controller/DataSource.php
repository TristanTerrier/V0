<?php

/**
 * Copyright (C) Phppot
 *
 * Distributed under 'The MIT License (MIT)'
 * In essense, you can do commercial use, modify, distribute and private use.
 * Though not mandatory, you are requested to attribute Phppot URL in your code or website.
 */

namespace Phppot;

/**
 * Generic datasource class for handling DB operations.
 * Uses MySqli and PreparedStatements.
 *
 * @version 2.7 - PDO connection option added
 */
class DataSource
{

    // PHP 7.1.0 visibility modifiers are allowed for class constants.
    // when using above 7.1.0, declare the below constants as private
    // for better encapsulation 
    // la je fait genre je 
    const HOST = 'localhost';

    const USERNAME = 'root';

    const PASSWORD = 'root';

    const DATABASENAME = 'nextutdp_bdd';

    private $conn;

    /**
     * PHP implicitly takes care of cleanup for default connection types.
     * So no need to worry about closing the connection.
     *
     * Singletons not required in PHP as there is no
     * concept of shared memory.
     * Every object lives only for a request.
     *
     * Keeping things simple and that works!
     */
    function __construct()
    {
        $this->conn = $this->getConnection();
    }

    /**
     * If connection object is needed use this method and get access to it.
     * Otherwise, use the below methods for insert / update / etc.
     *
     * @return \mysqli
     */
    public function getConnection()
    {
        $conn = new \mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);

        if (mysqli_connect_errno()) {
            trigger_error("Problem with connecting to database.");
        }

        $conn->set_charset("utf8");
        return $conn;
    }

    /**
     * If you wish to use PDO use this function to get a connection instance
     *
     * @return \PDO
     */
    public function getPdoConnection()
    {
        $conn = FALSE;
        try {
            $dsn = 'mysql:host=' . self::HOST . ';dbname=' . self::DATABASENAME;
            $conn = new \PDO($dsn, self::USERNAME, self::PASSWORD);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            exit("PDO Connect Error: " . $e->getMessage());
        }
        return $conn;
    }

    /**
     * To get database results
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return array
     */
    public function select($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (!empty($paramType) && !empty($paramArray)) {

            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        if (!empty($resultset)) {
            return $resultset;
        }
    }

    /**
     * To insert
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return int
     */
    public function insert($query, $paramType, $paramArray)
    {
        $stmt = $this->conn->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);

        $stmt->execute();
        $insertId = $stmt->insert_id;
        return $insertId;
    }

    /**
     * To execute query
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     */
    public function execute($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
    }

    /**
     * 1.
     * Prepares parameter binding
     * 2. Bind prameters to the sql statement
     *
     * @param string $stmt
     * @param string $paramType
     * @param array $paramArray
     */
    public function bindQueryParams($stmt, $paramType, $paramArray = array())
    {
        $paramValueReference[] = &$paramType;
        for ($i = 0; $i < count($paramArray); $i++) {
            $paramValueReference[] = &$paramArray[$i];
        }
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $paramValueReference);
    }

    /**
     * To get database results
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return array
     */
    public function getRecordCount($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);
        if (!empty($paramType) && !empty($paramArray)) {

            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;

        return $recordCount;
    }

    public function getQuestion($questionId)
    {
        $query = "SELECT quiz_question FROM tdp_questions WHERE question_id = ?";
        $paramType = "i";
        $paramArray = array($questionId);
        $result = $this->select($query, $paramType, $paramArray);
        if ($result) {
            return $result[0]['quiz_question'];
        } else {
            return "";
        }
    }

    public function getAnswersById($questionId)
    {
        $query = "SELECT answer FROM tdp_answers WHERE question_id = ?";
        $paramType = "i";
        $paramArray = array($questionId);

        $stmt = $this->conn->prepare($query);

        if (!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $answers = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $answers[] = $row['answer'];
            }
        }

        return $answers;
    }

    function getUserAnswers()
    {
        $userAnswers = array();

        foreach ($_POST as $key => $value) {
            if (strpos($key, 'answer_') !== false) {
                $answerId = (int) substr($key, strlen('answer_'));
                $userAnswers[] = $answerId;
            }
        }

        return $userAnswers;
    }

    public function getTotalQuestions()
    {
        $query = "SELECT COUNT(*) as count FROM tdp_questions";
        $result = $this->select($query);
        return $result[0]['count'];
    }

    function bindValue(&$stmt, $param, $value, $dataType = null)
    {
        switch ($dataType) {
            case 'int':
                $stmt->bindValue($param, (int) $value, SQLITE3_INTEGER);
                break;
            case 'float':
                $stmt->bindValue($param, (float) $value, SQLITE3_FLOAT);
                break;
            case 'bool':
                $stmt->bindValue($param, (bool) $value, SQLITE3_INTEGER);
                break;
            case 'null':
                $stmt->bindValue($param, null, SQLITE3_NULL);
                break;
            default:
                $stmt->bindValue($param, $value, SQLITE3_TEXT);
                break;
        }
    }

}
