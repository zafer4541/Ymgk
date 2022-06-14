<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;

class GetDailyNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getDailyName';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.collectapi.com/news/getNews?country=tr&tag=economy",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "uft-8",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: apikey 71LE8Ps3ECNcPZIQCRqiiQ:2ooNJleDJyhMtZtW7IGvHK ",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }
        else {
            $daily = json_decode($response);
            foreach ($daily->result as $item) {
                $news = new News();
                $news->type = 2;
                $news->url = $item->url;
                $news->image = $item->image;
                $news->title = $item->name;
                $news->save();
            }
        }

        return 0;
    }
}
