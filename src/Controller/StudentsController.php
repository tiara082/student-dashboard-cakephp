<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Event\EventInterface;
use Cake\Datasource\ConnectionManager;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 */
class StudentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

     public function index()
     {
         // Mendapatkan identitas pengguna yang sedang login
         $loggedInUser = $this->Authentication->getIdentity();
     
         if ($loggedInUser) {
             // Jika pengguna adalah admin, tampilkan seluruh data students
             if ($loggedInUser->level === 'admin') {
                $students = $this->paginate($this->Students->find()->where(['level !=' => 'admin']));
     

             } else {
                 // Jika pengguna adalah user, tampilkan data yang sesuai dengan ID pengguna
                 $students = $this->paginate($this->Students->find('all', [
                     'conditions' => ['id' => $loggedInUser->id]
                 ]));
     
                 $this->set(compact('students'));
             }
         } 
            $totalStudents = $this->Students->find()->where(['level !=' => 'admin'])->count();
            $femaleStudents = $this->Students->find()
                ->where(['gender' => 'female'])
                ->andWhere(['level !=' => 'admin'])
                ->count();

            $maleStudents = $this->Students->find()
                ->where(['gender' => 'male'])
                ->andWhere(['level !=' => 'admin'])
                ->count();

         $this->set(compact('students', 'totalStudents', 'femaleStudents', 'maleStudents'));
     }
     
    
    
    

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $student = $this->Students->get($id, contain: []);
        $this->set(compact('student'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
public function add()
{
    $student = $this->Students->newEmptyEntity();
    if ($this->request->is('post')) {
        $student = $this->Students->patchEntity($student, $this->request->getData());
        if ($this->Students->save($student)) {
            $this->Flash->success(__('Data Siswa berhasil ditambahkan'));
            return $this->redirect($this->referer());
        }
        $this->Flash->error(__('Data Siswa tidak berhasil ditambahkan, Silahkan coba lagi!'));
        return $this->redirect($this->referer());

    }
    $this->set(compact('student'));
}

    
    public function register()
    {
        $student = $this->Students->newEmptyEntity();
        if ($this->request->is('post')) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            if ($this->Students->save($student)) {
                $this->Flash->success(__('Data Siswa berhasil ditambahkan'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Data Siswa tidak berhasil ditambahkan, Silahkan coba lagi!'));
        }
        $this->set(compact('student'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $student = $this->Students->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            if ($this->Students->save($student)) {
                $this->Flash->success(__('Data Siswa berhasil diperbarui.'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Data Siswa tidak berhasil diperbarui, Silahkan coba lagi!'));
            return $this->redirect($this->referer());

        }
        $this->set(compact('student'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $student = $this->Students->get($id);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__('Data Siswa berhasil dihapus'));
        } else {
            $this->Flash->error(__('Data Siswa tidak berhasil dihapus, Silahkan coba lagi!'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
{
    parent::beforeFilter($event);
    // Configure the login action to not require authentication, preventing
    // the infinite redirect loop issue
    $this->Authentication->addUnauthenticatedActions(['login','register']);
}

public function login()
{
    $this->request->allowMethod(['get', 'post']);
    $result = $this->Authentication->getResult();

    if ($this->request->is('post')) {
        $username = $this->request->getData('username');
        $password = $this->request->getData('password');
    
        if ($username === 'admin' && $password === 'admin') {
            $adminUser = $this->Students->findByUsername('admin')->first();
            
            $this->Authentication->setIdentity($adminUser);
            
            return $this->redirect(['controller' => 'Students', 'action' => 'index']);

        }
    }
    if ($result->isValid()) {
        return $this->redirect(['controller' => 'Students', 'action' => 'index']);
    }
 
    if ($this->request->is('post') && !$result->isValid()) {
        $this->Flash->error(__('Username atau Password salah!'));

    }
}


public function logout()
{
    $result = $this->Authentication->getResult();
    if ($result && $result->isValid()) {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Students', 'action' => 'login']);
    }
}


public function chart()
{
    $maleBirthDates = $this->Students->find()
        ->select(['birth_date'])
        ->where(['gender' => 'male', 'level !=' => 'admin'])
        ->enableHydration(false)
        ->toArray();

    $femaleBirthDates = $this->Students->find()
        ->select(['birth_date'])
        ->where(['gender' => 'female', 'level !=' => 'admin'])
        ->enableHydration(false)
        ->toArray();

    // Format data birth date sesuai kebutuhan chart
    $maleData = $this->formatBirthDateData($maleBirthDates);
    $femaleData = $this->formatBirthDateData($femaleBirthDates);    
    $maleDataYear = $this->formatBirthYearData($maleBirthDates);
    $femaleDataYear = $this->formatBirthYearData($femaleBirthDates);

    $totalStudents = $this->Students->find()->where(['level !=' => 'admin'])->count();
    $femaleStudents = $this->Students->find()
        ->where(['gender' => 'female'])
        ->andWhere(['level !=' => 'admin'])
        ->count();

    $maleStudents = $this->Students->find()
        ->where(['gender' => 'male'])
        ->andWhere(['level !=' => 'admin'])
        ->count();
 $this->set(compact('maleData', 'femaleData', 'totalStudents', 'maleBirthDates','femaleBirthDates','femaleStudents', 'maleStudents','femaleDataYear','maleDataYear'));

}


private function formatBirthDateData($birthDates)
{
    $months = [
        'Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0,
        'May' => 0, 'Jun' => 0, 'Jul' => 0, 'Agu' => 0,
        'Sep' => 0, 'Okt' => 0, 'Nov' => 0, 'Des' => 0
    ];

    foreach ($birthDates as $birthDate) {
        $month = $birthDate['birth_date']->format('M');
        // Pengecekan apakah bulan terdefinisi dalam array $months
        if (array_key_exists($month, $months)) {
            $months[$month]++;
        }
    }

    return array_values($months);
}
private function formatBirthYearData($birthDates)
{
    $years = [];

    // Ambil semua tahun dari data tanggal lahir
    foreach ($birthDates as $birthDate) {
        $year = $birthDate['birth_date']->format('Y'); // Ambil tahun dari tanggal lahir
        $years[$year] = 0; // Inisialisasi jumlah kelahiran pada tahun tersebut
    }

    // Urutkan tahun dari terkecil ke terbesar
    ksort($years);

    // Hitung jumlah kelahiran per tahun
    foreach ($birthDates as $birthDate) {
        $year = $birthDate['birth_date']->format('Y'); // Ambil tahun dari tanggal lahir
        $years[$year]++; // Tambahkan jumlah kelahiran pada tahun yang sesuai
    }

    return array_values($years); // Mengembalikan array dengan jumlah kelahiran per tahun
}


public function print()
{
    // Mendapatkan identitas pengguna yang sedang login
    $loggedInUser = $this->Authentication->getIdentity();

    if ($loggedInUser) {
        // Jika pengguna adalah admin, tampilkan seluruh data students
        if ($loggedInUser->level === 'admin') {
           $students = $this->paginate($this->Students->find()->where(['level !=' => 'admin']));


        } else {
            // Jika pengguna adalah user, tampilkan data yang sesuai dengan ID pengguna
            $students = $this->paginate($this->Students->find('all', [
                'conditions' => ['id' => $loggedInUser->id]
            ]));

            $this->set(compact('students'));
        }
    } 
       $totalStudents = $this->Students->find()->where(['level !=' => 'admin'])->count();
       $femaleStudents = $this->Students->find()
           ->where(['gender' => 'female'])
           ->andWhere(['level !=' => 'admin'])
           ->count();

       $maleStudents = $this->Students->find()
           ->where(['gender' => 'male'])
           ->andWhere(['level !=' => 'admin'])
           ->count();

    $this->set(compact('students', 'totalStudents', 'femaleStudents', 'maleStudents'));
}

}
