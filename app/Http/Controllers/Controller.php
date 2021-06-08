<?php

namespace App\Http\Controllers;
//start
use Valiator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
//end

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showAllData(){
        return view('index');
    }

    //******* Settings
    public function showSettings(){
        return view('settings.settings');
    }

    public function export(){
        $username = env('DB_USERNAME');
        $dbname = env('DB_DATABASE');
        $d = date('Y-m-d');
        $dir = 'D:/Clinic_management_backups/' . $d . '/';
        $path = $dir . $dbname . '.sql';
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $command = "C:/xampp/mysql/bin/mysqldump.exe -u $username $dbname >" . $path;
        exec($command . ' 2>&1', $output);

        if (count($output) == 0) {
            echo "<script>alert('your DATABASE has been exported successfully, check your LOCAL DRIVE (D)');</script>";
            echo "<script> window.location.href= '/settings'</script>";
        } else {
            echo "<script>alert('Something wrong ! database not exported ');</script>";
            echo "<script> window.location.href= '/settings'</script>";
        }
    }

    public function drop(){
        // drop all the data from the database (no need for doctrine)
        DB::statement("SET foreign_key_checks=0");
        $databaseName = DB::getDatabaseName();
        $tables = DB::select("SELECT * FROM information_schema.tables WHERE table_schema = '$databaseName'");
        foreach ($tables as $table) {
            $name = $table->TABLE_NAME;
            //if you don't want to truncate migrations, cities
            if ($name == 'migrations' or $name == 'cities') {
                continue;
            }
            DB::table($name)->truncate();
        }
        DB::statement("SET foreign_key_checks=1");

        return redirect('settings');
    }

    public function import(){
        if (isset($_FILES['db'])) {
            $file = $_FILES['db'];
            $file_name = $_FILES['db']['name'];
            $file_type = $_FILES['db']['type'];
            $file_size = $_FILES['db']['size'];
            $file_temp = $_FILES['db']['tmp_name'];
            move_uploaded_file($file_temp, "$file_name");

            $servername = env('DB_HOST');
            $username = env('DB_USERNAME');
            $password = env('DB_PASSWORD');
            $dbname = env('DB_DATABASE');

            function restoreDatabaseTables($servername, $username, $password, $dbname, $filePath){
                set_time_limit(600); //used to temporarily extend the time limit.
                // Temporary variable, used to store current query
                $templine = '';
                // Read in entire file
                $lines = file($filePath);
                $error = '';
                // Loop through each line
                foreach ($lines as $line) {
                    // Skip it if it's a comment
                    if (substr($line, 0, 2) == '--' || $line == '') {
                        continue;
                    }
                    // Add this line to the current segment
                    $templine .= $line;
                    // If it has a semicolon at the end, it's the end of the query
                    if (substr(trim($line), -1, 1) == ';') {
                        // Perform the query
                        //if (!$db->query($templine)) {
                        if (!DB::unprepared($templine)) {
                                $error .= 'Error performing query "<b>' . $templine . '</b>": ' . $db->error . '<br /><br />';
                        }
                        // Reset temp variable to empty
                        $templine = '';
                    }
                }
                return !empty($error) ? $error : true;
            }

            $filePath   = $file_name;
            if (
                restoreDatabaseTables($servername, $username, $password, $dbname, $filePath)
                and $file_name != ""
            ) {
                unlink("$file_name");
                echo "<script>alert('Database imported successfully!')</script>";
                echo '<script>window.location.href = "/settings"</script>'; // redirect to home.php
            } else {
                echo "<script>alert('Something wrong! database not imported !')</script>";
                echo '<script>window.location.href = "/settings"</script>'; // redirect to home.php
            }
        }
    }





    //******* Account **********//
    public function showAccount(){
        return view('account.account')
            ->with('user', User::all());
    }
    public function updateAccount(){
        return view('account.account');
    }



    //******* Login **********//
    public function showLogin(){
        return view('account.login');
    }
}
