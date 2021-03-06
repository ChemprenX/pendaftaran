<?php
use Illuminate\Database\Seeder;
/**
 * Usage :
 * [1] $ composer dump-autoload -o
 * [2] $ php artisan db:seed --class=BantenprovPendaftaranSeeder
 */
class BantenprovPendaftaranSeeder extends Seeder
{
    /* text color */
    protected $RED     ="\033[0;31m";
    protected $CYAN    ="\033[0;36m";
    protected $YELLOW  ="\033[1;33m";
    protected $ORANGE  ="\033[0;33m";
    protected $PUR     ="\033[0;35m";
    protected $GRN     ="\e[32m";
    protected $WHI     ="\e[37m";
    protected $NC      ="\033[0m";
    /* File name */
    /* location : /databse/seeds/file_name.csv */
    protected $fileName = "BantenprovPendaftaranSeeder.csv";
    /* text info : default (true) */
    protected $textInfo = true;
    /* model class */
    protected $model;
    /* __construct */
    public function __construct(){
        $this->model = new Bantenprov\Pendaftaran\Models\Bantenprov\Pendaftaran\Pendaftaran;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertData();
    }
    /* function insert data */
    protected function insertData()
    {
        /* silahkan di rubah sesuai kebutuhan */
        foreach($this->readCSV() as $data){

            
        	$this->model->create([
            	'user_id' => $data['user_id'],
				'kegiatan_id' => $data['kegiatan_id'],
				'tanggal_pendaftaran' => $data['tanggal_pendaftaran'],

        	]);
        

        }

        if($this->textInfo){                
            echo "============[DATA]============\n";
            $this->orangeText('user_id : ').$this->greenText($data['user_id']);
			echo"\n";
			$this->orangeText('kegiatan_id : ').$this->greenText($data['kegiatan_id']);
			echo"\n";
			$this->orangeText('tanggal_pendaftaran : ').$this->greenText($data['tanggal_pendaftaran']);
			echo"\n";
        
            echo "============[DATA]============\n\n";
        }

        $this->greenText('[ SEEDER DONE ]');
        echo"\n\n";
    }
    /* text color: orange */
    protected function orangeText($text)
    {
        printf($this->ORANGE.$text.$this->NC);
    }
    /* text color: green */
    protected function greenText($text)
    {
        printf($this->GRN.$text.$this->NC);
    }
    /* function read CSV file */
    protected function readCSV()
    {
        $file = fopen(database_path("seeds/".$this->fileName), "r");
        $all_data = array();
        $row = 1;
        while(($data = fgetcsv($file, 1000, ",")) !== FALSE){
            $all_data[] = ['user_id' => $data[0],
            'kegiatan_id' => $data[1],
            'tanggal_pendaftaran' => $data[2],
            ];
        }
        fclose($file);
        return  $all_data;
    }
}
