<?php

class UserCollection extends Collection {

    protected $table = 'users';
    protected $entity = 'UserEntity';

    public function save($object)
    {
        $data = [
            'id'        => $object->getId(),
            'username'  => $object->getUsername(),
            'password'  => $object->getPassword(),
            'email'     => $object->getEmail(),
        ];

        if (is_null($object->getId())) {
            //Insert new record
            $result = $this->insert($data);
        } else {
            //Update data
            $where = [
                'id' => $object->getId(),
            ];
            unset($data['password']);

            $result = $this->update($data, $where);
        }

        return $result;
    }




}