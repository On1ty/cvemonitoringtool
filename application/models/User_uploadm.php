<?php

class User_uploadm extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function saveIdentity($data)
    {
        $this->db->insert('identity_doc', $data);
        return $this->db->affected_rows() > 0;
    }

    public function saveEnrollment($data)
    {
        $this->db->insert('enrollment_doc', $data);
        return $this->db->affected_rows() > 0;
    }

    public function saveEmployment($data)
    {
        $this->db->insert('employment_doc', $data);
        return $this->db->affected_rows() > 0;
    }

    public function saveFinancial($data)
    {
        $this->db->insert('financial_doc', $data);
        return $this->db->affected_rows() > 0;
    }

    public function saveVerifiable($data)
    {
        $this->db->insert('verifiable_doc', $data);
        return $this->db->affected_rows() > 0;
    }

    public function saveEvidence($data)
    {
        $this->db->insert('evidence_doc', $data);
        return $this->db->affected_rows() > 0;
    }

    public function saveOther($data)
    {
        $this->db->insert('other_doc', $data);
        return $this->db->affected_rows() > 0;
    }

    public function saveFees($data)
    {
        $this->db->insert('fees_doc', $data);
        return $this->db->affected_rows() > 0;
    }
}
