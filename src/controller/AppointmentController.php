<?php
/**
* 
*/
class AppointmentController extends Controller
{
	

	protected $entityAppointment; 
	protected $entityAppAni; 
	protected $entityUser; 
	protected $entitySpecie; 
	

	function __construct(){

		parent::__construct();
		$this->entityAppointment = new EntityManager('Appointments');
		$this->entityUser = new UserManager();
		$this->entitySpecie = new EntityManager('Species');
		$this->entityAppAni = new AppointmentManager();
		
	}

	
	public function view($page = 1){
		parent::view();
		$pagination = new Pagination($this->entityAppAni->counter()->Counter,4,$page);

		return $this->render("/admin/appointment/appointment.php", ['a' => $this->entityAppAni->ReadApp($pagination),'pagination' => $pagination]);

	}

	protected function deleteAction($idApp,$idAni){
		if (!empty($idApp) && !empty($idAni)) {
			//effacer dans la table de relation 
			//compter combien id pareil 
			//si le nombre id == 0
			//on supprime de rdv dans Appointments
			$this->entityAppAni->DeleteApp($idApp,$idAni);
			$count = $this->entityAppAni->countById($idApp)->nbCount;
			if ($count == 0) {
				$this->entityAppointment->Delete($idApp);
			}
			
		}
		return true;
	}
	

	public function create(){
		$params = $_POST;
		if (!empty($params)) {
			$listAnimals = $params['listAnimals'];
			$params['dateOfApp'] = (!empty($params['dateOfApp']))? date("Y-m-d", strtotime($params['dateOfApp'])):null;
			unset($params['idSpecie'],$params['idBreed'],$params['listAnimals']);
			$params = $this->secureForm($params);
			$this->entityAppointment->Create($params);
			$lstID = $this->entityAppointment->lastId();
			foreach ($listAnimals as $key => $value) {
				$this->entityAppAni->CreateAppAnimals($lstID,$value);
			}
			$this->redirect('http://'.$this->request->getNameServer().'/appointment/view/');
		}
		return $this->render("/admin/appointment/createAppointment.php", ['user' => $this->entityUser->Read(), 'race' => $this->entitySpecie->Read()]);

	}
	public function update($id){
		$params = $_POST;
		if (!empty($params)) {
			$listAnimals = $params['listAnimals'];
			$params['dateOfApp'] = (!empty($params['dateOfApp']))? date("Y-m-d", strtotime($params['dateOfApp'])):null;
			unset($params['idSpecie'],$params['idBreed'],$params['listAnimals']);
			$params = $this->secureForm($params);
			$this->entityAppointment->Update($id,$params);
			$this->entityAppAni->DeleteApp($id);
			foreach ($listAnimals as $key => $value) {
				$this->entityAppAni->CreateAppAnimals($id,$value);
			}
			$this->redirect('http://'.$this->request->getNameServer().'/appointment/view/');
		}
		return $this->render("/admin/appointment/updateAppointment.php", ['donnees' => $this->entityAppAni->FindByIdApp($id), 'user' => $this->entityUser->Read(), 'race' => $this->entitySpecie->Read()]);

	}

}