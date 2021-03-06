<?php

class _ extends ALTER_TABLE
{
    // start statement
    public function SHOW_FULL_TABLES_FROM($database)
    {
        $this->query = 'SHOW FULL TABLES FROM '.self::cleanSmt(trim($database));

        return $this;
    }

    // start statement
    public function SET($variable, $value)
    {
        $this->query = 'SET '.$variable.'  = '.$value;
    }

    // start statement
    public function GRANT_ALL_PRIVILEGES()
    {
        $this->query = 'GRANT ALL PRIVILEGES ON';

        return $this;
    }

    public function SELECT_SQL_CALC_FOUND_ROWS($smt)
    {
        return $this->SELECT($smt);
    }

    // possbile start statement
    public function SELECT($smt)
    {
        if (is_array($smt) && count($smt) > 0)
        {
            $this->query .= ' SELECT ';

            $clean_smt_array = array();
            foreach ($smt as $elements)
            {
                $clean_smt_array[] = self::cleanSmt(trim($elements));
            }
            $this->query .= implode(', ', $clean_smt_array);
        }
        else
        {
            $this->query .= ' SELECT '.$smt;
        }

        return $this;
    }

    // possbile start statement
    public function SELECT_COUNT($smt)
    {

        $this->query .= ' SELECT COUNT('.$smt.')';

        return $this;
    }

    public function SELECT_NOW()
    {
        $this->query = 'SELECT NOW()';

        return $this;
    }

    public function FROM($smt)
    {
        $this->query .= ' FROM '.trim($smt);

        return $this;
    }

    public function WHERE($smt, $smt1 = FALSE, $smt2 = FALSE)
    {
        if (is_array($smt) && count($smt) == 3)
        {
            $this->query .= ' WHERE '.trim($smt[0]).' '.trim($smt[1]).' '.trim($smt[2]);
        }

        if (is_string($smt))
        {
            if ($smt1 !== FALSE && $smt2 !== FALSE)
            {
                $this->query .= ' WHERE '.trim($smt).' '.trim($smt1).' '.trim($smt2);
            }
            else
            {
                $this->query .= ' WHERE '.trim($smt);
            }
        }

        return $this;
    }

    public function LIKE($smt)
    {
        $this->query .= ' LIKE'.trim($smt);

        return $this;
    }

    public function ORDER_BY($smt)
    {
        $this->query .= ' ORDER BY '.trim($smt);

        return $this;
    }

    public function ASC()
    {
        $this->query .= ' ASC';

        return $this;
    }

    public function DESC()
    {
        $this->query .= ' DESC';

        return $this;
    }

    public function ON($value)
    {
        $value =  str_replace('_' , '\_', $value);
        $this->query .= ' ON '.self::cleanSmt(trim($value));

        return $this;
    }

    public function TO($value)
    {
        $this->query .= ' TO '.trim($value);

        return $this;
    }
}
