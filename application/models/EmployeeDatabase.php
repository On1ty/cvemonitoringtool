<?php

class EmployeeDatabase extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    //NEW
    public function employee_login($username = null, $password = null)
    {
        // 1); //Administrator
        // 2); //Marketing
        // 3); //Documentation
        // 4); //Approver
        // 5); //Super User
        $this->db->where('emp_name', $username);
        $query = $this->db->get('employee');
        $row = $query->row_array();

        $hashed = $row ? $row['emp_pass'] : '';
        if (password_verify($password, $hashed))
            return $row;
    }

    public function getClients()
    {
        return $this->db->query('SELECT clients.emp_id, clients.id_lead, client_first, client_middle, client_last, client_phone, client_email, clients.created_time, emp_last, emp_first, clients.real_id FROM clients INNER JOIN employee ON clients.created_by = employee.emp_id WHERE clients.id_lead IN (SELECT id FROM lead_payment WHERE `type` = 4)');
    }

    //OLD
    public function endorseToDocumentationTeam($id, $stage, $status)
    {
        $this->db->set('status', $status);
        $this->db->where('id_lead', $id);
        $this->db->where('stage', $stage);
        $this->db->update('stages');
        return $this->db->affected_rows() > 0;
    }

    public function insertToEndorse($data)
    {
        return $this->db->insert('endorsed', $data);
    }

    public function markAsEndorsed($id, $stage)
    {
        $this->db->set('encrypt', 'Mark as Endorsed');
        $this->db->set('file', 'Mark as Endorsed');
        $this->db->set('type', 'Mark as Endorsed');
        $this->db->set('upload_date', date('c'));
        $this->db->where('uploaded_by', $id);
        $this->db->where('stage', $stage);
        $this->db->update('clients_files');
        return $this->db->affected_rows() > 0;
    }

    public function getEndorsedClients()
    {
        $query = "SELECT clients.real_id,";
        $query .= "endorsed.view, endorsed.id_lead,";
        $query .= "CONCAT(clients.client_first, ' ', clients.client_middle, ' ', clients.client_last) as full_name,";
        $query .= "clients.client_phone, clients.client_email, CONCAT(employee.emp_first, ' ', employee.emp_last) as employee_name ";
        $query .= 'FROM endorsed ';
        $query .= 'INNER JOIN clients ';
        $query .= 'ON clients.id_lead = endorsed.id_lead ';
        $query .= 'INNER JOIN employee ';
        $query .= 'ON clients.created_by = employee.emp_id;';

        return $this->db->query($query);
    }

    public function markAsRead($id_lead)
    {
        $this->db->set('view', 1);
        $this->db->where('id_lead', $id_lead);
        $this->db->update('endorsed');
        return $this->db->affected_rows() > 0;
    }

    public function getClientsCurrentAndDoneStage($id_lead, $with_done)
    {
        $with_done_query = "";
        if ($with_done) {
            $with_done_query = "OR status = \"done\"";
        }

        return $this->db->query("SELECT stage, status, id_lead FROM stages WHERE id_lead = $id_lead AND (status = \"current\" $with_done_query)");
    }

    public function acceptEndorsed($id, $stage, $status)
    {
        $this->db->set('status', $status);
        $this->db->where('id_lead', $id);
        $this->db->where('stage', $stage);
        $this->db->update('stages');
        return $this->db->affected_rows() > 0;
    }

    public function activate($id)
    {
        $this->db->set('isActive', 1);
        $this->db->where('id_lead', $id);
        $this->db->update('clients');
        return $this->db->affected_rows() > 0;
    }

    public function deactivate($id)
    {
        $this->db->set('isActive', 0);
        $this->db->where('id_lead', $id);
        $this->db->update('clients');
        return $this->db->affected_rows() > 0;
    }

    public function countFilesSubmittedOnSpecificStage($stage, $id_lead)
    {
        $this->db->where('stage', $stage);
        $this->db->where('uploaded_by', $id_lead);
        $this->db->from('clients_files');
        return $this->db->count_all_results();
    }

    public function approveStage($stage, $id_lead)
    {
        $this->db->set('status', 'done');
        $this->db->where('stage', $stage);
        $this->db->where('id_lead', $id_lead);
        $this->db->update('stages');
    }

    public function autoNextStage($stage, $id_lead)
    {
        $this->db->set('status', 'current');
        $this->db->set('switch', 1);
        $this->db->where('stage', $stage);
        $this->db->where('id_lead', $id_lead);
        $this->db->update('stages');
    }

    public function getAllRolesEmail($role)
    {
        $this->db->where('role', $role);
        $this->db->select('emp_name');
        return $this->db->get('employee')->row_array();
    }

    public function getNotesByClientsId($id_lead)
    {
        $this->db->select('notes.id, notes.note, notes.noted_date, employee.emp_last, employee.role');
        $this->db->from('notes');
        $this->db->join('employee', 'employee.real_id = notes.noted_by', 'left');
        $this->db->where('id_lead', $id_lead);
        $this->db->order_by('noted_date', 'DESC');
        return $this->db->get()->result();
    }

    public function addNotes($data)
    {
        $this->db->insert('notes', $data);
        return $this->db->affected_rows() > 0;
    }

    public function updateClientsInfo($data, $id_lead)
    {
        $this->db->set($data);
        $this->db->where('id_lead', $id_lead);
        $this->db->update('clients_info');
        return $this->db->affected_rows() > 0;
    }

    public function updateClientsEmail($data, $id_lead)
    {
        $this->db->set($data);
        $this->db->where('id_lead', $id_lead);
        $this->db->update('clients');
        return $this->db->affected_rows() > 0;
    }

    public function employeeDetails($id)
    {
        $this->db->where('emp_id', $id);
        return $this->db->get('employee')->row();
    }

    public function updateEmployeeInfo($id = null, $data)
    {
        $this->db->set($data);
        $this->db->where('emp_id', $id);
        $this->db->update('employee');
        return $this->db->affected_rows() > 0;
    }

    public function checkCurrentPassword($id, $data)
    {
        // $this->db->set($data);
        // $this->db->update('employee');
        // return $this->db->affected_rows() > 0;

        $this->db->where('emp_id', $id);
        $query = $this->db->get('employee');
        $row = $query->row_array();

        $hashed = $row ? $row['emp_pass'] : '';
        if (password_verify($data, $hashed))
            return true;
        return false;
    }

    public function changeEmployeePassword($id, $new)
    {
        $this->db->where('emp_id', $id);
        $this->db->set('emp_pass', $new);
        $this->db->update('employee');
        return $this->db->affected_rows() > 0;
    }

    public function getUsers()
    {
        return $this->db->get('employee');
    }
}
