<?php
class MainController extends BaseController
{
    //model variable
    private $model;

    function __construct()
    {
        //load model
        $this->model = $this->load_model('Main');
    }

    //home
    public function index()
    {
        if(checkLogin()){
            $this->redirect('main/dashboard');
            return true;
        }

        $meta['page_title'] = APP_NAME;
        $data['message'] = 'Welcome';
        $this->load_view('/pages/landing_page',$meta, $data);
    }

    //open journal
    public function dashboard()
    {
        if(!checkLogin()){
            $this->redirect('main/dashboard');
            return true;
        }
        $meta['page_title'] = 'Dashboard';
        $data['message'] = 'Welcome';
        $data['journals'] = $this->model->retrieve_all('tbl_journals', '*', ['user_id'=>$_SESSION['user_id']], 'ORDER BY published_date DESC');

        $this->load_view('/pages/dashboard',$meta, $data);
    }

    //add new journal
    public function add_journal(){
        $this->validatePost();
        $journal_entry = [
            'journal_title'=>(empty($_POST['journal_title'])?'Untitled':$_POST['journal_title']),
            'journal_body'=>$_POST['journal_body']
        ];
        $date = date('Y-m-d H:i:s');
        $data = [
            'user_id'=>$_SESSION['user_id'],
            'journal_details' => json_encode($journal_entry),
            'published_date' => $date,
        ];

        $id = $this->model->insert_data('tbl_journals', $data, true);
        $journal_entry['journal_id']=$id;
        $journal_entry['published_date']=getTimeDifference($date);
        echo json_encode($journal_entry);
    }

    //edit journal
    public function edit_journal(){
        $this->validatePost();
        $journal_entry = [
            'journal_title'=>(empty($_POST['journal_title'])?'Untitled':$_POST['journal_title']),
            'journal_body'=>$_POST['journal_body']
        ];
        $data = [
            'journal_details' => json_encode($journal_entry)
        ];
        $where = [
            'id' => $_POST['journal_id'],
        ];

        $this->model->update_row('tbl_journals', $data, $where);

        echo json_encode($journal_entry);
    }

    //delete journal
    public function delete_journal(){
        $this->validatePost();

        $where = [
            'id' => $_POST['entry_id'],
        ];

        $this->model->delete('tbl_journals', $where);

        echo json_encode('deleted');
    }

    //update post time (1m ago)
    public function updateEntryTimers(){
        $journals = $this->model->retrieve_all('tbl_journals', 'id,published_date', ['user_id'=>$_SESSION['user_id']], 'ORDER BY published_date DESC');
        $journal_timers = [];
        foreach ($journals as $journal){
            $journal_timers['journal_'.$journal->id] = date('d M y, H:i', strtotime($journal->published_date)).' ('.getTimeDifference($journal->published_date).')';
        }
        echo json_encode($journal_timers);
    }

    //viewing journal info
    public function getJournalDetails(){
        $this->validatePost();
        $journal= $this->model->retrieve_row('tbl_journals', 'journal_details', ['id'=>$_POST['entry_id']]);
        echo $journal->journal_details;
    }

    //function to send journals to random user
    public function sendJournals(){

        $journals_last_24_hours = $this->model->retrieve_all(
            'tbl_journals', 'user_id,journal_details',
            [   'published_date>='=>date('Y-m-d 12:00:00',strtotime("-1 days")),
                'published_date<='=>date('Y-m-d 12:00:00')
            ]);
        $users_posted_previous_day = $this->model->retrieve_all_with_join(
            'tbl_journals', 'DISTINCT(a.user_id),b.email_address', ['table'=>'tbl_users', 'clause'=>'a.user_id=b.user_id'],
            [   'a.published_date>='=>date('Y-m-d 00:00:00',strtotime("-1 days")),
                'a.published_date<='=>date('Y-m-d 23:59:59',strtotime("-1 days"))
            ]);
        $users=[];

        foreach ($users_posted_previous_day as $user){
            $users[$user->user_id] = $user->email_address;
        }

        $users_exclude_author='';
        if(!empty($journals_last_24_hours)){
            foreach ($journals_last_24_hours as $journal){
                $users_exclude_author = $users;
                unset($users_exclude_author[$journal->user_id]);
                if(!empty($users_exclude_author)){
                    $send_to = $users_exclude_author[array_rand($users_exclude_author)];
                    send_email($send_to, json_decode($journal->journal_details)->journal_title, json_decode($journal->journal_details)->journal_body);
                    echo "Sent to ".$send_to."<br> ";
                }
            }
        }
    }

    public function testCRON(){
        send_email('barasabwb17@gmail.com', 'LOTTO NUMBER', rand(1000,9999));
    }
}
