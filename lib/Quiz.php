
<?php

public function getSingleValue($query, $paramType = "", $paramArray = array()) {
    $stmt = $this->conn->prepare($query);

    if (!empty($paramType) && !empty($paramArray)) {
        $this->bindQueryParams($stmt, $paramType, $paramArray);
    }

    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();

    return $result;
}

?>