<head>
    <meta charset="UTF-8">
    <title>Activity Log</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px #ccc;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8f8f8;
        }
        tr:nth-child(even) {
            background-color: #f1f1f1;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>User Activity Log</h2>

<table>
    <thead>
        <tr>
            <th>Date & Time</th>
            <th>Username</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php

        // Path to the log file
        $logFile = '../activity_logs.txt'; // Update this path to

        if (file_exists($logFile)) {
            $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($lines as $line) {
                // Parse line format: [timestamp] [user] message
                if (preg_match('/\[(.*?)\] \[(.*?)\] (.*)/', $line, $matches)) {
                    echo "<tr>";
                    echo "<td>{$matches[1]}</td>";  // Timestamp
                    echo "<td>{$matches[2]}</td>";  // Username
                    echo "<td>{$matches[3]}</td>";  // Message
                    echo "</tr>";
                }
            }
        } else {
            echo "<tr><td colspan='3'>Log file not found.</td></tr>";
        }
        ?>
    </tbody>
</table>