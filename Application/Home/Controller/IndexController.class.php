<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {

    const DEFAULT_CNT = 5;
    const DEFAULT_RESIDUE = 1;

    public function index() {
        try {
            for ($i = 1;; $i++) {
                if ($this->checkResidueCnt($i)) {
                    $m1 = $this->getResidueCnt($i);
                    if ($this->checkResidueCnt($m1)) {
                        $m2 = $this->getResidueCnt($m1);
                        if ($this->checkResidueCnt($m2)) {
                            $m3 = $this->getResidueCnt($m2);
                            if ($this->checkResidueCnt($m3)) {
                                $m4 = $this->getResidueCnt($m3);
                                if ($this->checkResidueCnt($m4)) {
                                    $m5 = $this->getResidueCnt($m4);
                                    if ($this->checkResidueCnt($m5)) {
                                        echo $i;
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
            }

        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    private function getResidueCnt($i) {
        $res = $i - round($i / self::DEFAULT_CNT) - 1;
        return $res;
    }

    private function checkResidueCnt($r) {
        if ($r % self::DEFAULT_CNT == self::DEFAULT_RESIDUE) {
            return true;
        } else {
            return false;
        }
    }

    public function monkeyTest() {
        try {
            $num = I('num');
            $iden = I('iden');
            if (empty($num) || empty($iden)) {
                throw new \Exception("参数不全", 10002);
            }

            $monkeys = range(1, $num);
            for ($i = 0;; $i++) {
                if (count($monkeys) > 1) {
                    if (($i + 1) % $iden == 0) {
                        unset($monkeys[$i]);
                    } else {
                        array_push($monkeys, $monkeys[$i]);
                        unset($monkeys[$i]);
                    }
                } else {
                    break;
                }
            }

            echo current($monkeys);
            exit;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function hannuo($n, $x, $y, $z) {
        if ($n == 1) {
            echo 'move disk 1 from ' . $x . ' to ' . $z . "\n";
        } else {
            $this->hannuo($n - 1, $x, $z, $y);
            echo 'move disk ' . $n . ' from ' . $x . ' to ' . $z . "\n";
            $this->hannuo($n - 1, $y, $x, $z);
        }
    }

    public function hannuoTest() {
        $this->hannuo(10, 'A', 'B', 'C');
    }
}