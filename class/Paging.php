<?php
/**
 * A Class use to Mysql page
 *
 * @author      Avenger <avenger@php.net>
 * @version     1.02
 * @update      2003-04-27 23:11:29
 *
 *
 * Useage:
 * $p = new show_page;      // Create the Object
 * $p->file="ttt.php";      // Set used the class name,default to the
 PHP_SELF * $p->pvar="pagecount";    // Set the page parameter,default to "p"
 * $p->setvar(array("a" => '1', "b" => '2'));   // Set the parameter u
 wanta pass, Note:used it above the $p->set * $p->set(20,2000,1);      // Set the
 object parameter,total 3,1st is the
 pagesize,2nd is the total record count,3rd is the currerent page
 count,default is will auto read the GET variable * $p->output(0);           //
 Output,the parameter is true will return a
 string * echo $p->limit(0);       // Out put the limit.eg. "SELECT * FROM TABLE
 LIMIT {$p->limit()}"; set it true,will return a array *
 */


class Paging {

    /**
     * output
     *
     * @var string
     */
    var $output;

    /**
     * used the class's page
     *
     * @var string
     */
    var $file;

    /**
     * page pass parameter
     *
     * @var string
     */
    var $pvar = "p";

    /**
     * pagesize
     *
     * @var integer
     */
    var $psize;

    /**
     * currerent page
     *
     * @var ingeger
     */
    var $curr;

    /**
     * pass array
     *
     * @var array
     */
    var $varstr;

    /**
     * total page count
     *
     * @var integer
     */
    var $tpage;


    /**
     * page set
     *
     * @access public
     * @param int $pagesize The pagesize
     * @param int $total    The toal records count
     * @param int $current  Current page,keep empty will auto read the get
     variable     * @return void
     */
     function set($pagesize=20,$total,$current=false) {
        global $HTTP_SERVER_VARS,$HTTP_GET_VARS;

        $this->tpage = ceil($total/$pagesize);
        if (!$current) {$current = $HTTP_GET_VARS[$this->pvar];}
        if ($current>$this->tpage) {$current = $this->tpage;}
        if ($current<1) {$current = 1;}

        $this->curr  = $current;
        $this->psize = $pagesize;

        if (!$this->file) {
            $this->file = $HTTP_SERVER_VARS['PHP_SELF'];
        }
        strstr($this->file,'?') ? $middle = '&amp;' : $middle = '?';

        if ($this->tpage > 1) {

                                  $start  = floor($current/11)*11;
            $end    = $start+10;

            if ($start<1)           $start=1;
            if ($end>$this->tpage)  $end=$this->tpage;

                                  //print First/Previous link if necessary
                      if($start != 1){
                                        $this->output.='<a class="en1"
                                        href='.$this->file.$middle.$this->pvar.'=1'.($this->varstr).'
                                        title="First" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();"><< First </a>&nbsp;';   
										
										$this->output.='<a class="en1"
                href='.$this->file.$middle.$this->pvar.'='.($start-1).($this->varstr).'
                title="Previous 10" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();">< Previous 10 </a>&nbsp;';            }
                                $this->output.=' [ ';

                                //print the number page
            for ($i=$start; $i<=$end; $i++) {
                                        if($i == $current){
                    $this->output.='<font color="red"
                    class="en1">'.$i.'</font>&nbsp;';                } else {
                    $this->output.='<a class="en1"
                    href="'.$this->file.$middle.$this->pvar.'='.$i.$this->varstr.'" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();">'.$i.'</a>&nbsp;';
                                   }
            }
                                $this->output.=' ] ';
                                //print Last/Next link if necessary
            if ($end < $this->tpage) {
                $this->output.='<a class="en1"
                href='.$this->file.$middle.$this->pvar.'='.($end+1).($this->varstr).'
                title="Next 10" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();"> Next 10 ></a>&nbsp;';           
                        $this->output.='<a class="en1"
                    href='.$this->file.$middle.$this->pvar.'='.($this->tpage).($this->varstr).'
                    title="Last" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();"> Last >></a>&nbsp;';                                }
        }
    }

    /**
     * passed variable set
     *
     * @access public
     * @param array $data  The parameter u wanta passed,see the example
     above.     * @return void
     */
     function setvar($data) {
        foreach ($data as $k=>$v) {
            $this->varstr.='&'.$k.'='.urlencode($v);
        }
    }

    /**
     * Output
     *
     * @access public
     * @param bool $return  Set it true will return a string,otherwish
     will output automatic     * @return string
     */
     function output($return = false) {
        if ($return) {
            return $this->output;
        } else {
            echo $this->output;
        }
    }

    /**
     * Make the limit
     *
     * @access public
     * @return string
     */
     function limit($arr=0) {
        if ($arr) {
            settype($arr,"array");
            $arr[1] = ($this->curr-1)*$this->psize;
            $arr[2] = $this->psize;
            return $arr;
        } else {
            return (($this->curr-1)*$this->psize).','.$this->psize;
        }
    }

} //End Class
?>
