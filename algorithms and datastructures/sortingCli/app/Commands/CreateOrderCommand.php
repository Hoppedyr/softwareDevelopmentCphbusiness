<?php

namespace App\Commands;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use GuzzleHttp\Client;
use Faker;

class CreateOrderCommand extends Command
{
    /** @var Faker\Generator */
    public $faker;

    public function __construct()
    {
        parent::__construct();
        $this->faker = Faker\Factory::create('de_DE');
    }

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'shopware:create:order {number=1}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create test Shopware order {number : number of orders to create}';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $baseUri = 'https://wexo.shopwaredemo.store/sales-channel-api/v1/';
        $swAccessKey = 'SWSCZ1G3DE1WC2P1DDZ4EUNTVW';
        $salutationId = "df2cbba052254b5eac43732e79219932";

        $number = $this->argument('number');
        for ($i = 1; $i <= $number; $i++) {
            echo "Creating order nr. " . $i . " of " . $number;
            $this->createOrder($baseUri, $swAccessKey, $salutationId);
            echo "Order nr. " . $i . " Created";
        }
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
    
    public function createOrder($baseUri, $swAccessKey, $salutationId)
    {
        $http = new Client([
            'base_uri' => $baseUri,
            'headers' => [
                'sw-access-key' => $swAccessKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);

        $responseRaw = $http->request('get', 'product?limit=500')
            ->getBody()->getContents();
        $response = json_decode($responseRaw);

        $productIds = [];
        foreach ($response->data as $product) {
            $productIds[] = $product->id;
        }

        $responseRaw = $http->request('post', 'checkout/cart')
            ->getBody()->getContents();
        $response = json_decode($responseRaw);

        $swContextToken = $response->{'sw-context-token'};

        for ($i = 0; $i < rand(1, 5); $i++) {
            $productId = $productIds[rand(0, 499)];

            $http->request('post', 'checkout/cart/product/' . $productId . "?quantity=" . rand(0, 5), [
                "headers" => [
                    "sw-context-token" => $swContextToken
                ]
            ])->getBody()->getContents();
        }

        $responseRaw = $http->request('post', 'country', [
            "headers" => [
                "sw-context-token" => $swContextToken
            ]
        ])->getBody()->getContents();
        $response = json_decode($responseRaw);

        $body = [
            "accountType" => "private",
            "salutationId" => $salutationId,
            "firstName" => $this->faker->firstName,
            "lastName" => $this->faker->lastName,
            "email" => $this->faker->email,
            "billingAddress" => [
                "countryId" => $response->data[0]->id,
                "street" => $this->faker->streetName . $this->faker->numberBetween(1, 100),
                "zipcode" => $this->faker->numberBetween(10000, 99999),
                "city" => $this->faker->city
            ]
        ];

        $http->request('post', 'checkout/guest-order', [
            "headers" => [
                "sw-context-token" => $swContextToken
            ],
            "json" => $body
        ])->getBody();
    }
}
