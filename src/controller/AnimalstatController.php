<?php
/**
* 
*/
class AnimalstatController extends Controller
{
	

	protected $entityAnimal; 
	protected $entityBreed; 
	protected $entitySpecie; 

	function __construct(){

		parent::__construct();
		$this->entityAnimal = new AnimalManager();
		$this->entityBreed = new BreedManager();
		$this->entitySpecie = new EntityManager('Species');	
	}
	
	public function view(){
		parent::view();
		$nbAnimalBySpecie = [];		
		foreach ($this->entitySpecie->Read() as $key => $value) {
			$nbAnimalBySpecie[$value->name] = $this->entityAnimal->countByIdSpecie($value->id)->countAnimals;
		}
		return $this->render("/public/statAnimal.php", ['nbAnimal' => $this->entityAnimal->counter(), 'nbAnimalBySpecie' => $nbAnimalBySpecie]);

	}
}