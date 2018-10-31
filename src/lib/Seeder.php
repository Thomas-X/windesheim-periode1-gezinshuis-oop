<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25/10/18
 * Time: 02:39
 */

namespace Qui\lib;

use Qui\lib\facades\Authentication;
use Qui\lib\facades\DB;
use Qui\lib\facades\DB_PDO;

class Seeder
{
    public static $faker;
    public static $total = 0;
    public static $totalDone = 0;

    /*
     * stolen from: https://stackoverflow.com/a/27147177
     * prints a fancy progress bar
     * */
    private static function progressBar($done, $total)
    {
        $perc = floor(($done / $total) * 100);
        $left = 100 - $perc;
        $write = sprintf("\033[0G\033[2K[%'={$perc}s>%-{$left}s] - $perc%% - $done/$total", "", "");
        fwrite(STDERR, $write);
    }

    private static function run_seed($factory, $postRun = '')
    {
        $sqlStatements = $factory();
        foreach ($sqlStatements as $sqlStatement) {
            DB::execute($sqlStatement, []);
            if ($postRun != '' && $postRun != null) {
                $postRun(DB_PDO::lastInsertId());
            }
            Seeder::progressBar(Seeder::$totalDone, Seeder::$total);
        }
    }

    // a factory that creates a .. factory??! madness!
    private static function factory_generator($templateGenerator, $fields, $table, $howMany = 1000)
    {
        $arr = [];
        DB::execute("DELETE FROM {$table}");
        for ($i = 0; $i < $howMany; $i++) {
            $val = $templateGenerator();
            $str = '';
            foreach ($val as $idx => $item) {
                if (array_search($idx, array_keys($val)) == (count(array_keys($val)) - 1)) {
//                    $str .= $table === 'users' ? "\"\"" : "\"{$item}\"";
                    $str .= "\"{$item}\"";
                } else {
                    $str .= "\"{$item}\",";
                }
            }
            $arr[] = "INSERT INTO `{$table}` ({$fields}) VALUES ({$str})";
        }
        return $arr;
    }

    public static function seed($shouldRun)
    {
        if (!$shouldRun) {
            return 'fail';
        }
        $faker = \Faker\Factory::create();
        Seeder::$faker = $faker;
        try {
            // Seed logic / data
            function printToConsole($name)
            {
                echo PHP_EOL . PHP_EOL . "starting {$name} seed.." . PHP_EOL . PHP_EOL;
            }
            $range = [51, 1500];

            /*
             * currently seeded tables:
             * users
             * profiles
             * profiles_parents_caretakers
             * profiles_doctors
             * profiles_kids
             * profiles_employees
             * careforschemas
             * events
             * day2dayinformation
             *
             * */

            echo printToConsole("user & profiles (so total is x2)");
            static::users($faker->numberBetween(...$range));

            echo printToConsole("profiles_parents_caretakers");
            static::profiles_parents_caretakers($faker->numberBetween(...$range));

            echo printToConsole("profiles_doctors");
            static::profiles_doctors($faker->numberBetween(...$range));

            echo printToConsole("profiles_kids");
            static::profiles_kids($faker->numberBetween(...$range));

            echo printToConsole("profiles_employees");
            static::profiles_employees($faker->numberBetween(...$range));

            echo printToConsole("careforschemas");
            static::careforschemas($faker->numberBetween(...$range));

            echo printToConsole("events");
            static::events($faker->numberBetween(...$range));

            echo printToConsole("day2dayinformation");
            static::day2dayinformation($faker->numberBetween(...$range));

            echo printToConsole("comments");
            static::comments($faker->numberBetween(...$range));

        } catch (\Exception $exception) {
            return $exception;
        }
        return 'success';
    }

    // Could be done better without copy pasta. But cant be bothered since this is seed
    public static function users($howMany)
    {
        DB::execute('DELETE FROM profiles');
        $faker = Seeder::$faker;
        // because 1:1 1 user 1 profile
        Seeder::$total = $howMany;
        Seeder::$totalDone = 0;
        $factory = function () use ($faker, $howMany) {
            return static::factory_generator(function () use ($faker) {
                Seeder::$totalDone += 1;
                return [
                    'fname' => $faker->firstName,
                    'lname' => $faker->lastName,
                    'email' => $faker->email,
                    'mobile' => $faker->phoneNumber,
                    'lastLogin' => $faker->dateTimeBetween('-365 days', 'now')->format('Y-m-d'),
                    'roles_id' => 1,
                    'password' => Authentication::generateRandomString(),
                    'rememberMeToken' => Authentication::generateRandomString(),
                    'forgotPasswordToken' => "",
                ];
            }, "`fname`, `lname`, `email`, `mobile`, `lastLogin`, `roles_id`, `password`, `rememberMeToken`, `forgotPasswordToken`", 'users', $howMany);
        };
        static::run_seed($factory, function ($id) use ($faker) {
            Seeder::$totalDone += 1;
            $key = $faker->randomElement([
                'profiles_parents_caretakers_id',
                'profiles_doctors_id',
                'profiles_employees_id',
                'profiles_kids_id'
            ]);
            DB::execute("INSERT INTO profiles (`users_id`,`{$key}`) VALUES ({$id}, '1')");
        });
    }

    private static function profile_generator($howMany, $cb)
    {
        $faker = Seeder::$faker;
        Seeder::$total = $howMany;
        Seeder::$totalDone = 0;
        $factory = function () use ($faker, $howMany, $cb) {
            $inst = $cb($faker);
            $fields = $inst['fields'];
            $table = $inst['table'];
            return static::factory_generator(function () use ($faker,$cb) {
                $inst = $cb($faker);
                $obj = $inst['obj'];
                return $obj;
            }, $fields, $table, $howMany);
        };
        static::run_seed($factory, function () {
            Seeder::$totalDone += 1;
        });
    }

    private static function profiles_parents_caretakers($howMany)
    {
        static::profile_generator($howMany, function ($faker) {
            $robj = [];
            $robj['obj'] = [
                'nickname' => $faker->firstName . ' ' . $faker->lastName,
                'dateofbirth' => $faker->date,
                'picture' => $faker->imageUrl()
            ];
            $robj['fields'] = "`nickname`, `dateofbirth`, `picture`";
            $robj['table'] = 'profiles_parents_caretakers';
            return $robj;
        });
    }

    private static function profiles_doctors($howMany)
    {
        static::profile_generator($howMany, function ($faker) {
            $robj = [];
            $robj['obj'] = [
                'nickname' => $faker->firstName . ' ' . $faker->lastName,
                'dateofbirth' => $faker->date,
                'proficiency' => $faker->text(300),
            ];
            $robj['fields'] = "`nickname`, `dateofbirth`, `proficiency`";
            $robj['table'] = 'profiles_doctors';
            return $robj;
        });
    }

    private static function profiles_employees($howMany)
    {
        static::profile_generator($howMany, function ($faker) {
            $robj = [];
            $robj['obj'] = [
                'nickname' => $faker->firstName . ' ' . $faker->lastName,
                'dateofbirth' => $faker->date,
                'picture' => $faker->text(300),
            ];
            $robj['fields'] = "`nickname`, `dateofbirth`, `picture`";
            $robj['table'] = 'profiles_employees';
            return $robj;
        });
    }

    private static function profiles_kids($howMany)
    {
        static::profile_generator($howMany, function ($faker) {
            $robj = [];
            $robj['obj'] = [
                'nickname' => $faker->firstName . ' ' . $faker->lastName,
                'dateofbirth' => $faker->date,
                'reason' => $faker->text(300),
            ];
            $robj['fields'] = "`nickname`, `dateofbirth`, `reason`";
            $robj['table'] = 'profiles_kids';
            return $robj;
        });
    }

    private static function careforschemas($howMany)
    {
        static::profile_generator($howMany, function ($faker) {
            $robj = [];
            $range = [0, 40];
            $nums = [0,1];
            $robj['obj'] = [
                'date_start' => '1300-10-05',
                'date_review' => $faker->date,
                'name' => $faker->firstName . ' ' . $faker->lastName . ' behandelplan',
                'extra' => $faker->text(50),
                'profiles_doctors_id' => $faker->numberBetween(...$range),
                'profiles_kids_id' => $faker->numberBetween(...$range),
                'profiles_parents_caretakers_id' => $faker->numberBetween(...$range),
                'parent_has_permission' => $faker->randomElement($nums),
                'kid_has_permission' => $faker->randomElement($nums),
            ];
            $robj['fields'] = "`date_start`, `date_review`, `name`, `extra`, `profiles_doctors_id`, `profiles_kids_id`, `profiles_parents_caretakers_id`, `parent_has_permission`, `kid_has_permission`";
            $robj['table'] = 'careforschemas';
            return $robj;
        });
    }

    private static function events($howMany)
    {
        static::profile_generator($howMany, function ($faker) {
            $robj = [];

            $robj['obj'] = [
                'date_event' => $faker->date,
                'eventname' => $faker->countryCode . ' ' . $faker->address,
                'pictures' => $faker->imageUrl(800, 600, 'cats'),
            ];
            $robj['fields'] = "`date_event`, `eventname`, `pictures`";
            $robj['table'] = 'events';
            return $robj;
        });
    }

    private static function day2dayinformation($howMany)
    {
        static::profile_generator($howMany, function ($faker) {
            $robj = [];
            $range = [0, 40];

            $robj['obj'] = [
                'date' => $faker->date,
                'description' => $faker->text(100),
                'title' => $faker->text(5),
                'profiles_employees_id' => $faker->numberBetween(...$range),
            ];
            $robj['fields'] = "`date`, `description`, `title`, `profiles_employees_id`";
            $robj['table'] = 'day2dayinformation';
            return $robj;
        });
    }

    private static function comments($howMany)
    {
        static::profile_generator($howMany, function ($faker) {
            $robj = [];
            $range = [0, 40];
            $arr = [$faker->numberBetween(...$range), 1];
            $events_id = $faker->randomElement($arr);
            $day2dayinformation_id = 1;
            if ($events_id == 1) {
                $day2dayinformation_id = $faker->randomElement($arr);
            }
            $robj['obj'] = [
                'comment' => $faker->text(30),
                'votes' => $faker->numberBetween(0, 2000),
                'events_id' => $events_id,
                'day2dayinformation_id' => $day2dayinformation_id
            ];
            $robj['fields'] = "`comment`, `votes`, `events_id`, `day2dayinformation_id`";
            $robj['table'] = 'comments';
            return $robj;
        });
    }
}