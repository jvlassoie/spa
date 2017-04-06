<?php
/**
* 
*/
class AppointmentController extends Controller
{
	

	protected $entityAppointment; 
	protected $entityUser; 
	protected $entitySpecie; 

	function __construct(){

		parent::__construct();
		$this->entityAppointment = new EntityManager('Appointments');
		$this->entityUser = new UserManager();
		$this->entitySpecie = new EntityManager('Species');
	}

	
	public function view(){
		parent::view();
		return $this->render("/admin/appointment/appointment.php", ['a' => $this->entityAppointment->Read()]);

	}

	protected function deleteAction($id){
		if (!empty($id)) {
			$this->entityAppointment->Delete($id);
		}
		return true;
	}
	

	public function create(){
		$params = $_POST;
		if (!empty($params)) {
			$this->entityAppointment->Create($params);
			$this->redirect('http://'.$this->request->getNameServer().'/appointment/view/');
		}
		return $this->render("/admin/appointment/createAppointment.php", ['user' => $this->entityUser->Read(), 'race' => $this->entitySpecie->Read()]);

	}
	public function update($id){
		$params = $_POST;
		if (!empty($params)) {
			$this->entityAppointment->Update($id,$params);
			$this->redirect('http://'.$this->request->getNameServer().'/appointment/view/');
		}
		return $this->render("/admin/appointment/updateAppointment.php", ['donnees' => $this->entityAppointment->FindById($id), 'user' => $this->entityUser->Read()]);

	}
}