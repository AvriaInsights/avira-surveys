<?php
//The stackoverflow link with detailed explanation
https://stackoverflow.com/questions/23544851/how-to-set-up-a-cron-job-programmatically

// Create a cron job
require_once 'xmlapi.php';

/*
 *  Instanciate the class, setting up username/password/IP
 *  @ip - cPanel server IP, if this script is on the cPanel server replace $ip by $ip = getenv('REMOTE_HOST');
 *  @account - string - your cPanel username
 *  @pass - string - your cPanel password
 */

$ip = '127.0.0.1';
$account = 'username';
$pass = "password";
$xmlapi = new xmlapi($ip, $account, $pass);

/*
 * Just to be sure that XML-API will use the correct port and protocol
 * @set_port(port); change port to 2082 if it isn't redirected to HTTPS and/or using HTTP protocol, else.. use 2083
 * @set_protocol(protocol); change protocol to http if your sever accept HTTP else put the protocol to https
 * @set_output(format); change to XML if you want the result output w/ XML, JSON if you want the result output w/ JSON
 */
$xmlapi->set_port('2083');
$xmlapi->set_protocol('https');
$xmlapi->set_output("json");
$xmlapi->set_debug(1);

/*
 *  @command string - The command, script, or program you wish for your cronjob to execute.
 *  @day int - The day on which you would like this crontab entry to run. Wildcards and any acceptable input to a crontab time expression line are allowed here.
 *  @hour int - The hour at which you would like this crontab entry to run. Wildcards and any acceptable input to a crontab time expression line are allowed here.
 *  @minute int - The minute at which you would like this crontab entry to run. Wildcards and any acceptable input to a crontab time expression line are allowed here.
 *  @month int - The month you would like this crontab entry to run. Wildcards and any acceptable input to a crontab time expression line are allowed here.
 *  @weekday int - The weekday on which you would like this crontab entry to run. Wildcards and any acceptable input to a crontab time expression line is allowed here. Acceptable values range from 0 to 6, where 0 represents Sunday and 6 represents Saturday.
 */

$command = "/usr/bin/php cron1.php";
$day = "1";
$hour = "1";
$minute = "1";
$month = "1";
$weekday = "1";

/*
 * @api2_query(account, module, function, params)
 */
print $xmlapi->api2_query($account, "Cron", "add_line", array(
    "command"=>$command,
    "day"=>$day,
    "hour"=>$hour,
    "minute"=>$minute,
    "month"=>$month,
    "weekday"=>$weekday
));

//Response 
//{"cpanelresult":{"module":"Cron","event":{"result":1},"apiversion":2,"data":[{"statusmsg":"crontab installed","status":1,"linekey":"9b0c93fe238a185e4aa78752a49a0718"}],"func":"add_line"}}

?>
