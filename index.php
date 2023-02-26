<?php

// Functions for reading and writing egg counts to the data file

function read_egg_counts_from_file($file_path) {
    $egg_counts = array();
    if (file_exists($file_path)) {
        $file_contents = file_get_contents($file_path);
        if ($file_contents !== false) {
            $egg_counts = json_decode($file_contents, true);
            if ($egg_counts === null) {
                $egg_counts = array();
            }
        }
    }
    return $egg_counts;
}

function write_egg_counts_to_file($file_path, $egg_counts) {
    $file_contents = json_encode($egg_counts);
    if ($file_contents !== false) {
        $result = file_put_contents($file_path, $file_contents);
        return $result !== false;
    }
    return false;
}

// Function for calculating monthly egg counts

function get_monthly_egg_counts($egg_counts) {
    $monthly_counts = array();
    foreach ($egg_counts as $date => $count) {
        $month = date('Y-m', strtotime($date));
        if (!isset($monthly_counts[$month])) {
            $monthly_counts[$month] = 0;
        }
        $monthly_counts[$month] += $count;
    }
    return $monthly_counts;
}

// Handle form submissions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $count = intval($_POST['count']);
    
    if (!empty($date) && $count > 0) {
        $file_path = "egg_counts.txt";
        $egg_counts = read_egg_counts_from_file($file_path);
        $egg_counts[$date] = $count;
        write_egg_counts_to_file($file_path, $egg_counts);
    }
}

// read egg counts from the file
$file_path = "egg_counts.txt";
$egg_counts = read_egg_counts_from_file($file_path);

// get monthly egg counts
$monthly_counts = get_monthly_egg_counts($egg_counts);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Hühnereier Zähler</title>
	    <style>
        body {
            background-color: #f2f2f2;
            color: #333333;
        }
        h1 {
            color: #555555;
        }
        h2 {
            color: #777777;
        }
        label {
            color: #555555;
        }
        button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0062cc;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Hühnereier Zähler</h1>

<form method="POST">
    <label>Date:</label>
    <input type="date" name="date" required><br><br>
    <label>Anzahl:</label>
    <input type="number" name="count" required>
    <button type="submit">Save</button>
</form>

    <h2>Gelegte Eier im Monat</h2>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>

    <?php
        // read egg counts from the file
        $file_path = "egg_counts.txt";
        $egg_counts = read_egg_counts_from_file($file_path);

        // get monthly egg counts
        $monthly_counts = get_monthly_egg_counts($egg_counts);

        // get the last month's egg count
        $last_month = date('Y-m', strtotime('last month'));
        $last_month_count = isset($monthly_counts[$last_month]) ? $monthly_counts[$last_month] : 0;

        // generate a message
        $message = sprintf("Im letzten Monat haben unsere Hühner %d Eier gelegt. %s",
                           $last_month_count,
                           urlencode("🥚🐓🐔"));
    ?>

    <h2>Erstelle eine Nachricht</h2>
    <p>Im letzten Monat haben unsere Hühner <?php echo $last_month_count ?> Eier gelegt.</p>
    <p><button onclick="copyToClipboard('<?php echo $message ?>')">Kopiere die Nachricht</button></p>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // load the Google Charts library
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // create a new data table
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Eier');

            // add the monthly egg counts to the data table
            <?php foreach ($monthly_counts as $month => $count) { ?>
            data.addRow(['<?php echo $month ?>', <?php echo $count ?>]);
            <?php } ?>

            // set chart options
            var options = {
                title: 'Gelegte Eier im Monat',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            // create and draw the chart
            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

        function copyToClipboard(text) {
            // create a temporary input element to copy the text
            var tempInput = document.createElement("input");
            tempInput.value = decodeURIComponent(text);
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            // alert the user that the text has been copied
            // alert("The message has been copied to the clipboard.");
        }
    </script>
</body

</html>

