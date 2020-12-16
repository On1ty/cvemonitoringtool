<?php

class Admin_registerm extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function searchEmployee($param = null)
    {
        // $this->db->where('role', 2);
        // $this->db->like('emp_last', $param);
        // $this->db->or_like('emp_first', $param);
        // $this->db->or_like('emp_middle', $param);
        // $this->db->or_like('real_id', $param);
        // return $this->db->get('employee');

        return $this->db->query("SELECT * FROM `employee` WHERE `role` = 2 AND (`emp_last` LIKE '%$param%' ESCAPE '!' OR `emp_first` LIKE '%$param%' ESCAPE '!' OR `emp_middle` LIKE '%$param%' ESCAPE '!' OR `real_id` LIKE '%$param%' ESCAPE '!')");
    }

    public function searchLeadData($param = null)
    {
        return $this->db->query('SELECT * FROM `lead_payment` INNER JOIN `lead_table` ON lead_payment.id = lead_table.id AND (lead_table.`id` LIKE ' . "'%" . $param . "%'" . ' OR lead_table.`full_name` LIKE ' . "'%" . $param . "%'" . ' OR lead_table.`email` LIKE ' . "'%" . $param . "%'" . ') AND (lead_payment.`type`="4") LEFT JOIN `clients` ON clients.id_lead = lead_payment.id GROUP BY lead_table.`full_name`');
    }

    public function checkIfIdExists($id)
    {
        $this->db->select('id');
        $this->db->where('id', $id);
        $query = $this->db->get('lead_table');
        return $query->row();
    }

    public function checkIfIdExistsInClients($id)
    {
        $this->db->select('id_lead');
        $this->db->where('id_lead', $id);
        $query = $this->db->get('clients');
        return $query->row();
    }

    public function pay($data)
    {
        $this->db->insert('lead_payment', $data);
        return $this->db->affected_rows() > 0;
    }

    public function admin_register($data)
    {
        $this->db->insert('clients', $data);
        return $this->db->affected_rows() > 0;
    }

    public function admin_register_clients_info($data)
    {
        $this->db->insert('clients_info', $data);
        return $this->db->affected_rows() > 0;
    }

    public function insert_stages($data)
    {
        $this->db->insert_batch('stages', $data);
        return $this->db->affected_rows() > 0;
    }

    public function emp_register($data)
    {
        $this->db->insert('employee', $data);
        return $this->db->affected_rows() > 0;
    }

    public function count_registered()
    {
        return $this->db->count_all_results('clients');
    }

    public function getWalkinTable()
    {
        return $this->db->query('SELECT * FROM clients INNER JOIN clients_info ON clients_info.id_lead = clients.id_lead WHERE clients.id_lead NOT IN(SELECT id FROM lead_table)');
    }

    public function getPaymentTableWalkin()
    {
        return $this->db->query('SELECT * FROM lead_payment INNER JOIN clients ON clients.id_lead = lead_payment.id WHERE clients.id_lead NOT IN(SELECT id FROM lead_table)');
    }

    public function clientsProfile($id)
    {
        $this->db->select('*');
        $this->db->from('clients');
        $this->db->join('clients_info', "clients_info.id_lead=$id AND clients.id_lead=$id", 'left');
        return $this->db->get()->row();
    }

    public function updateCounselor($data)
    {
        $this->db->set('created_by', $data['created_by']);
        $this->db->where('emp_id', $data['emp_id']);
        $this->db->update('clients');
        return $this->db->affected_rows() > 0;
    }

    public function getClients()
    {
        return $this->db->query('SELECT * FROM clients INNER JOIN clients_info ON clients.id_lead = clients_info.id_lead INNER JOIN employee ON clients.created_by = employee.emp_id  WHERE clients.id_lead IN (SELECT id FROM lead_payment WHERE `type` = 4)');
    }

    public function checkStageId($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('stages');
        return $query->num_rows();
    }

    public function updateStageSwitch($id, $status)
    {
        $this->db->set('switch', $status);
        $this->db->where('id', $id);
        return $this->db->update('stages');
    }

    public function autoUpdateStageSwitch($id, $status, $stage)
    {
        $this->db->set('switch', $status);
        $this->db->where('id_lead', $id);
        $this->db->where('stage', $stage);
        return $this->db->update('stages');
    }

    public function getClientStages($id)
    {
        $this->db->where('id_lead', $id);
        return $this->db->get('stages');
    }

    public function getClientsFile()
    {
        $query = $this->db->query('
            SELECT id, file, file_type, clients.emp_id, clients.client_last, category, orig_name, upload_date FROM identity_doc
            INNER JOIN clients
            ON
            identity_doc.uploaded_by = clients.emp_id
            UNION ALL
            SELECT id, file, file_type, clients.emp_id, clients.client_last, category, orig_name, upload_date FROM employment_doc
            INNER JOIN clients
            ON
            employment_doc.uploaded_by = clients.emp_id
            UNION ALL
            SELECT id, file, file_type, clients.emp_id, clients.client_last, category, orig_name, upload_date FROM enrollment_doc
            INNER JOIN clients
            ON
            enrollment_doc.uploaded_by = clients.emp_id
            UNION ALL
            SELECT id, file, file_type, clients.emp_id, clients.client_last, category, orig_name, upload_date FROM financial_doc
            INNER JOIN clients
            ON
            financial_doc.uploaded_by = clients.emp_id
            UNION ALL
            SELECT id, file, file_type, clients.emp_id, clients.client_last, category, orig_name, upload_date FROM verifiable_doc
            INNER JOIN clients
            ON
            verifiable_doc.uploaded_by = clients.emp_id
            UNION ALL
            SELECT id, file, file_type, clients.emp_id, clients.client_last, category, orig_name, upload_date FROM evidence_doc
            INNER JOIN clients
            ON
            evidence_doc.uploaded_by = clients.emp_id
            UNION ALL
            SELECT id, file, file_type, clients.emp_id, clients.client_last, category, orig_name, upload_date FROM other_doc
            INNER JOIN clients
            ON
            other_doc.uploaded_by = clients.emp_id
            UNION ALL
            SELECT id, file, file_type, clients.emp_id, clients.client_last, category, orig_name, upload_date FROM fees_doc
            INNER JOIN clients
            ON
            fees_doc.uploaded_by = clients.emp_id

            ORDER BY category ASC
        ');

        return $query;
    }
}
