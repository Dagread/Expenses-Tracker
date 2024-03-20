<?php
class Date{
    private $monthToNumber = [
        "jan"=> 1,
        "feb"=> 2,
        "mar"=> 3,
        "apr"=> 4,
        "may"=> 5,
        "jun"=> 6,
        "jul"=> 7,
        "aug"=> 8,
        "sep"=> 9,
        "oct"=> 10,
        "nov"=> 11,
        "dec"=> 12

    ];
    public int $year;
    public int $month;
    public int $day;

    // function Date(string $date){
    //     if(str_contains($date, "/")){
    //         $dateSplit = explode("/", $date);
    //         $this->day = (int)$dateSplit[0];
    //         $this->month = (int)$dateSplit[1];
    //         $this->year = (int)$dateSplit[2];
    //     }else if(str_contains($date, " ")){
    //         $dateSplit = explode(" ", $date);
    //         $this->day = (int)str_replace(",", " ", $dateSplit[1]);
    //         $this->month = $this->monthToNumber[strtolower(substr($dateSplit[0], 0, 3))];
    //         $this->day = (int)$dateSplit[2];
    //     }
    // }

    function Date(int $year, int $month, int $day){
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    // not an actual value, just an approximation
    function daysBetween(Date $other){
        $days = abs($other->year - $this->year)*365;
        $days += abs($other->month - $this->month)*365/12;
        $days += abs($other->day - $this->day);

        return $days;
    }
}

class MonetaryValue{
    private float $valueInCad;
    private float $valueInHours;
    private float $salaryPerHour;
    function MonetaryValue(float $valueInCad, float $salaryPerHour){
        $this->valueInCad = $valueInCad;
        $this->valueInHours = $valueInCad / $salaryPerHour;
        $this->salaryPerHour = $salaryPerHour;
    }

    function getCad(){
        return $this->valueInCad;
    }

    function getHours(){
        return $this->valueInHours;
    }

    function getSalary(){
        return $this->salaryPerHour;
    }
}

class Expense{
    private MonetaryValue $value;
    private Date $date;
    private string $name;
    function Expense(string $name, MonetaryValue $value, Date $date){
        $this->value = $value;
        $this->date = $date;
        $this->name = $name;
    }

    function Display(){

    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Expenses Tracker</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            text-align: left;
            padding: 8px;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Expenses Tracker</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Value (CAD)</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php
        // Assuming you have an array of Expense objects called $expenses
        foreach ($expenses as $expense) {
            echo "<tr>";
            echo "<td>" . $expense->name . "</td>";
            echo "<td>" . $expense->value->getCad() . "</td>";
            echo "<td>" . $expense->date->day . "/" . $expense->date->month . "/" . $expense->date->year . "</td>";
            echo "<td><button class='button'>Edit</button><button class='button'>Delete</button></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>