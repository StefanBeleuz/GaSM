<?php
session_start();

class Report extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('ReportModel');
    }

    public function index()
    {
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

        $activeReports = $this->model->getActiveReports();
        $likedReports = $this->model->getLikedReports($username);
        $dislikedReports = $this->model->getDislikedReports($username);
        $likes = $this->model->getTotalLikes();
        $dislikes = $this->model->getTotalDislikes();

        $this->view('report/report', [
            'active_reports' => $activeReports,
            'liked_reports' => $likedReports, 'disliked_reports' => $dislikedReports,
            'likes' => $likes, 'dislikes' => $dislikes
        ]);

        if (isset($_POST['submit'])) {
            // create report
            $type = $_POST['type'];
            if ($type == 'garbage-full')
                $type = 1;
            else if ($type == 'garbage-not-sorted')
                $type = 2;
            $location = $_POST['location'];
            date_default_timezone_set('Europe/Bucharest');
            $date = date('Y-m-d H:i:s');
            $user = isset($_SESSION['username']) ? $_SESSION['username'] : 'Anonymous';
            $this->model->doReport($type, $location, $date, $user);

            $this->redirect('report');
        }

        if (isset($_POST['done'])) {
            // mark a report as done (delete)
            $id = $_POST['report_id'];
            $this->model->deleteReport($id);

            $this->redirect('report');
        }
    }

    public function newAction($report_id, $action)
    {
        // only logged in users can vote
        if (isset($_SESSION['username'])) {
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Anonymous';
            $this->model->newAction($report_id, $action, $username);
        }

        $likes = $this->model->getLikes($report_id);
        $dislikes = $this->model->getDislikes($report_id);

        echo $likes . " " . $dislikes;
    }
}
