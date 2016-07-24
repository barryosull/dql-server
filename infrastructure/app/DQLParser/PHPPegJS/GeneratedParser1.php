<?php
/*
 * Generated by PEG.js 0.8.0. with php-pegjs plugin
 *
 * http://pegjs.majda.cz/
 */

namespace Infrastructure\App\DQLParser\PHPPegJS;

/* Usefull functions: */

/* chr_unicode - get unicode character from its char code */
if (!function_exists('Infrastructure\App\DQLParser\PHPPegJS\\chr_unicode')) { function chr_unicode($code) { return mb_convert_encoding('&#' . $code . ';', 'UTF-8', 'HTML-ENTITIES');} }
/* peg_regex_test - multibyte regex test */
if (!function_exists('Infrastructure\App\DQLParser\PHPPegJS\\peg_regex_test')) { function peg_regex_test($pattern, $string) { if (substr($pattern, -1) == 'i') return mb_eregi(substr($pattern, 1, -2), $string); else return mb_ereg(substr($pattern, 1, -1), $string);}}

/* Syntax error exception */
if (!class_exists("PhpPegJs\\SyntaxError", false)){
class SyntaxError extends \Exception
{
    public $expected;
    public $found;
    public $grammarOffset;
    public $grammarLine;
    public $grammarColumn;
    public $name;
    public function __construct($message, $expected, $found, $offset, $line, $column)
    {
        parent::__construct($message, 0, null);
        $this->expected = $expected;
        $this->found = $found;
        $this->grammarOffset = $offset;
        $this->grammarLine = $line;
        $this->grammarColumn = $column;
        $this->name = "SyntaxError";
    }
};}

class GeneratedParser{


    private $peg_currPos          = 0;
    private $peg_reportedPos      = 0;
    private $peg_cachedPos        = 0;
    private $peg_cachedPosDetails = array('line' => 1, 'column' => 1, 'seenCR' => false );
    private $peg_maxFailPos       = 0;
    private $peg_maxFailExpected  = array();
    private $peg_silentFails      = 0;
    private $input                = "";


    private function cleanup_state(){
      $this->peg_currPos          = 0;
      $this->peg_reportedPos      = 0;
      $this->peg_cachedPos        = 0;
      $this->peg_cachedPosDetails = array('line' => 1, 'column' => 1, 'seenCR' => false );
      $this->peg_maxFailPos       = 0;
      $this->peg_maxFailExpected  = array();
      $this->peg_silentFails      = 0;
      $this->input                = "";

    }


    private function text() {
      return substr($this->input, $this->peg_reportedPos, $this->peg_reportedPos + $this->peg_currPos);
    }

    private function offset() {
      return $this->peg_reportedPos;
    }

    private function line() {
      $compute_pd = $this->peg_computePosDetails($this->peg_reportedPos);
      return $compute_pd["line"];
    }

    private function column() {
      $compute_pd = $this->peg_computePosDetails($this->peg_reportedPos);
      return $compute_pd["column"];
    }

    private function expected($description) {
      throw $this->peg_buildException(
        null,
        array(array("type" => "other", "description" => $description )),
        $this->peg_reportedPos
      );
    }

    private function error($message) {
      throw $this->peg_buildException($message, null, $this->peg_reportedPos);
    }

    private function peg_computePosDetails($pos) {
      $self = $this;
      $advance = function(&$details, $startPos, $endPos) use($self) {
        for ($p = $startPos; $p < $endPos; $p++) {
          $ch = mb_substr($self->input, $p, 1, "UTF-8");
          if ($ch === "\n") {
            if (!$details["seenCR"]) { $details["line"]++; }
            $details["column"] = 1;
            $details["seenCR"] = false;
          } else if ($ch === "\r" || $ch === "\u2028" || $ch === "\u2029") {
            $details["line"]++;
            $details["column"] = 1;
            $details["seenCR"] = true;
          } else {
            $details["column"]++;
            $details["seenCR"] = false;
          }
        }
      };

      if ($this->peg_cachedPos !== $pos) {
        if ($this->peg_cachedPos > $pos) {
          $this->peg_cachedPos = 0;
          $this->peg_cachedPosDetails = array( "line" => 1, "column" => 1, "seenCR" => false );
        }
        $advance($this->peg_cachedPosDetails, $this->peg_cachedPos, $pos);
        $this->peg_cachedPos = $pos;
      }

      return $this->peg_cachedPosDetails;
    }

    private function peg_fail($expected) {
      if ($this->peg_currPos < $this->peg_maxFailPos) { return; }

      if ($this->peg_currPos > $this->peg_maxFailPos) {
        $this->peg_maxFailPos = $this->peg_currPos;
        $this->peg_maxFailExpected = array();
      }

      $this->peg_maxFailExpected[] = $expected;
    }

    private function peg_buildException($message, $expected, $pos) {
      $cleanupExpected = function (&$expected){
        $i = 1;

        usort($expected, function($a, $b) {
          if ($a["description"] < $b["description"]) {
            return -1;
          } else if ($a["description"] > $b["description"]) {
            return 1;
          } else {
            return 0;
          }
        });

        while ($i < count($expected)) {
          if ($expected[$i - 1] === $expected[$i]) {
            array_splice($expected, $i, 1);
          } else {
            $i++;
          }
        }
      };

      $buildMessage = function ($expected, $found) {
        $stringEscape = function ($s) {
          $hex = function($ch) { return strtoupper(dechex(ord($ch[0])));};

            $s = str_replace("\\",   "\\\\", $s);
            $s = str_replace("\"",    "\\\"", $s);
            $s = str_replace('\x08', '\\b', $s);
            $s = str_replace('\t',   '\\t', $s);
            $s = str_replace('\n',   '\\n', $s);
            $s = str_replace('\f',   '\\f', $s);
            $s = str_replace('\r',   '\\r', $s);
            $s = preg_replace_callback('/[\\x00-\\x07\\x0B\\x0E\\x0F]/u', function($ch) use($hex) { return '\\x0' + $hex($ch[0]); }, $s);
            $s = preg_replace_callback('/[\\x10-\\x1F\\x80-\\xFF]/u',     function($ch) use($hex) { return '\\x'  + $hex($ch[0]); }, $s);
            return $s;
        };

        $expectedDescs = array_fill(0, count($expected), null);

        for ($i = 0; $i < count($expected); $i++) {
          $expectedDescs[$i] = $expected[$i]["description"];
        }

        $expectedDesc = count($expected) > 1
          ? join(", ", array_slice($expectedDescs, 0, -1))
              . " or "
              . $expectedDescs[count($expected) - 1]
          : $expectedDescs[0];

        $foundDesc = $found ? "\"" . $stringEscape($found) . "\"" : "end of input";

        return "Expected " . $expectedDesc . " but " . $foundDesc . " found.";
      };

      $posDetails = $this->peg_computePosDetails($pos);
      $found      = $pos < mb_strlen($this->input, "UTF-8") ? mb_substr($this->input, $pos, 1, "UTF-8") : null;

      if ($expected !== null) {
        $cleanupExpected($expected);
      }

      return new SyntaxError(
        $message !== null ? $message : $buildMessage($expected, $found),
        $expected,
        $found,
        $pos,
        $posDetails["line"],
        $posDetails["column"]
      );
    }

    private $peg_FAILED;
    private $peg_c0;
    private $peg_c1;
    private $peg_c2;
    private $peg_c3;
    private $peg_c4;
    private $peg_c5;
    private $peg_c6;
    private $peg_c7;
    private $peg_c8;
    private $peg_c9;
    private $peg_c10;
    private $peg_c11;
    private $peg_c12;
    private $peg_c13;
    private $peg_c14;
    private $peg_c15;
    private $peg_c16;
    private $peg_c17;
    private $peg_c18;
    private $peg_c19;
    private $peg_c20;
    private $peg_c21;
    private $peg_c22;

    private function peg_parseCommand() {

      $s0 = $this->peg_parseCreateEnvironment();
      if ($s0 === $this->peg_FAILED) {
        $s0 = $this->peg_parseUsingEnvironment();
      }

      return $s0;
    }

    private function peg_parseCreateEnvironment() {

      $s0 = $this->peg_currPos;
      $s1 = $this->peg_parse_();
      if ($s1 !== $this->peg_FAILED) {
        if (mb_substr($this->input, $this->peg_currPos, 6, "UTF-8") === $this->peg_c1) {
          $s2 = $this->peg_c1;
          $this->peg_currPos += 6;
        } else {
          $s2 = $this->peg_FAILED;
          if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c2); }
        }
        if ($s2 !== $this->peg_FAILED) {
          $s3 = $this->peg_parse_();
          if ($s3 !== $this->peg_FAILED) {
            if (mb_substr($this->input, $this->peg_currPos, 11, "UTF-8") === $this->peg_c3) {
              $s4 = $this->peg_c3;
              $this->peg_currPos += 11;
            } else {
              $s4 = $this->peg_FAILED;
              if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c4); }
            }
            if ($s4 !== $this->peg_FAILED) {
              $s5 = $this->peg_parse_();
              if ($s5 !== $this->peg_FAILED) {
                $s6 = $this->peg_parseQuotedName();
                if ($s6 !== $this->peg_FAILED) {
                  $s7 = $this->peg_parse_();
                  if ($s7 !== $this->peg_FAILED) {
                    if (mb_substr($this->input, $this->peg_currPos, 1, "UTF-8") === $this->peg_c5) {
                      $s8 = $this->peg_c5;
                      $this->peg_currPos++;
                    } else {
                      $s8 = $this->peg_FAILED;
                      if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c6); }
                    }
                    if ($s8 !== $this->peg_FAILED) {
                      $s9 = $this->peg_parse_();
                      if ($s9 !== $this->peg_FAILED) {
                        $this->peg_reportedPos = $s0;
                        $s1 = call_user_func($this->peg_c7,$s6);
                        $s0 = $s1;
                      } else {
                        $this->peg_currPos = $s0;
                        $s0 = $this->peg_c0;
                      }
                    } else {
                      $this->peg_currPos = $s0;
                      $s0 = $this->peg_c0;
                    }
                  } else {
                    $this->peg_currPos = $s0;
                    $s0 = $this->peg_c0;
                  }
                } else {
                  $this->peg_currPos = $s0;
                  $s0 = $this->peg_c0;
                }
              } else {
                $this->peg_currPos = $s0;
                $s0 = $this->peg_c0;
              }
            } else {
              $this->peg_currPos = $s0;
              $s0 = $this->peg_c0;
            }
          } else {
            $this->peg_currPos = $s0;
            $s0 = $this->peg_c0;
          }
        } else {
          $this->peg_currPos = $s0;
          $s0 = $this->peg_c0;
        }
      } else {
        $this->peg_currPos = $s0;
        $s0 = $this->peg_c0;
      }

      return $s0;
    }

    private function peg_parseUsingEnvironment() {

      $s0 = $this->peg_currPos;
      $s1 = $this->peg_parse_();
      if ($s1 !== $this->peg_FAILED) {
        if (mb_substr($this->input, $this->peg_currPos, 5, "UTF-8") === $this->peg_c8) {
          $s2 = $this->peg_c8;
          $this->peg_currPos += 5;
        } else {
          $s2 = $this->peg_FAILED;
          if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c9); }
        }
        if ($s2 !== $this->peg_FAILED) {
          $s3 = $this->peg_parse_();
          if ($s3 !== $this->peg_FAILED) {
            if (mb_substr($this->input, $this->peg_currPos, 11, "UTF-8") === $this->peg_c3) {
              $s4 = $this->peg_c3;
              $this->peg_currPos += 11;
            } else {
              $s4 = $this->peg_FAILED;
              if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c4); }
            }
            if ($s4 !== $this->peg_FAILED) {
              $s5 = $this->peg_parse_();
              if ($s5 !== $this->peg_FAILED) {
                $s6 = $this->peg_parseQuotedName();
                if ($s6 !== $this->peg_FAILED) {
                  $s7 = $this->peg_parse_();
                  if ($s7 !== $this->peg_FAILED) {
                    if (mb_substr($this->input, $this->peg_currPos, 1, "UTF-8") === $this->peg_c5) {
                      $s8 = $this->peg_c5;
                      $this->peg_currPos++;
                    } else {
                      $s8 = $this->peg_FAILED;
                      if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c6); }
                    }
                    if ($s8 !== $this->peg_FAILED) {
                      $s9 = $this->peg_parse_();
                      if ($s9 !== $this->peg_FAILED) {
                        $this->peg_reportedPos = $s0;
                        $s1 = call_user_func($this->peg_c10,$s6);
                        $s0 = $s1;
                      } else {
                        $this->peg_currPos = $s0;
                        $s0 = $this->peg_c0;
                      }
                    } else {
                      $this->peg_currPos = $s0;
                      $s0 = $this->peg_c0;
                    }
                  } else {
                    $this->peg_currPos = $s0;
                    $s0 = $this->peg_c0;
                  }
                } else {
                  $this->peg_currPos = $s0;
                  $s0 = $this->peg_c0;
                }
              } else {
                $this->peg_currPos = $s0;
                $s0 = $this->peg_c0;
              }
            } else {
              $this->peg_currPos = $s0;
              $s0 = $this->peg_c0;
            }
          } else {
            $this->peg_currPos = $s0;
            $s0 = $this->peg_c0;
          }
        } else {
          $this->peg_currPos = $s0;
          $s0 = $this->peg_c0;
        }
      } else {
        $this->peg_currPos = $s0;
        $s0 = $this->peg_c0;
      }

      return $s0;
    }

    private function peg_parseQuotedName() {

      $s0 = $this->peg_parseSingleQuotedName();
      if ($s0 === $this->peg_FAILED) {
        $s0 = $this->peg_parseDoubleQuotedName();
      }

      return $s0;
    }

    private function peg_parseSingleQuotedName() {

      $s0 = $this->peg_currPos;
      if (mb_substr($this->input, $this->peg_currPos, 1, "UTF-8") === $this->peg_c11) {
        $s1 = $this->peg_c11;
        $this->peg_currPos++;
      } else {
        $s1 = $this->peg_FAILED;
        if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c12); }
      }
      if ($s1 !== $this->peg_FAILED) {
        $s2 = $this->peg_parseName();
        if ($s2 !== $this->peg_FAILED) {
          if (mb_substr($this->input, $this->peg_currPos, 1, "UTF-8") === $this->peg_c11) {
            $s3 = $this->peg_c11;
            $this->peg_currPos++;
          } else {
            $s3 = $this->peg_FAILED;
            if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c12); }
          }
          if ($s3 !== $this->peg_FAILED) {
            $this->peg_reportedPos = $s0;
            $s1 = call_user_func($this->peg_c13,$s2);
            $s0 = $s1;
          } else {
            $this->peg_currPos = $s0;
            $s0 = $this->peg_c0;
          }
        } else {
          $this->peg_currPos = $s0;
          $s0 = $this->peg_c0;
        }
      } else {
        $this->peg_currPos = $s0;
        $s0 = $this->peg_c0;
      }

      return $s0;
    }

    private function peg_parseDoubleQuotedName() {

      $s0 = $this->peg_currPos;
      if (mb_substr($this->input, $this->peg_currPos, 1, "UTF-8") === $this->peg_c14) {
        $s1 = $this->peg_c14;
        $this->peg_currPos++;
      } else {
        $s1 = $this->peg_FAILED;
        if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c15); }
      }
      if ($s1 !== $this->peg_FAILED) {
        $s2 = $this->peg_parseName();
        if ($s2 !== $this->peg_FAILED) {
          if (mb_substr($this->input, $this->peg_currPos, 1, "UTF-8") === $this->peg_c14) {
            $s3 = $this->peg_c14;
            $this->peg_currPos++;
          } else {
            $s3 = $this->peg_FAILED;
            if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c15); }
          }
          if ($s3 !== $this->peg_FAILED) {
            $this->peg_reportedPos = $s0;
            $s1 = call_user_func($this->peg_c16,$s2);
            $s0 = $s1;
          } else {
            $this->peg_currPos = $s0;
            $s0 = $this->peg_c0;
          }
        } else {
          $this->peg_currPos = $s0;
          $s0 = $this->peg_c0;
        }
      } else {
        $this->peg_currPos = $s0;
        $s0 = $this->peg_c0;
      }

      return $s0;
    }

    private function peg_parseName() {

      $s0 = $this->peg_currPos;
      $s1 = $this->peg_c17;
      if (peg_regex_test($this->peg_c18, mb_substr($this->input, $this->peg_currPos, 1, "UTF-8"))) {
        $s2 = mb_substr($this->input, $this->peg_currPos, 1, "UTF-8");
        $this->peg_currPos++;
      } else {
        $s2 = $this->peg_FAILED;
        if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c19); }
      }
      if ($s2 !== $this->peg_FAILED) {
        while ($s2 !== $this->peg_FAILED) {
          $s1[] = $s2;
          if (peg_regex_test($this->peg_c18, mb_substr($this->input, $this->peg_currPos, 1, "UTF-8"))) {
            $s2 = mb_substr($this->input, $this->peg_currPos, 1, "UTF-8");
            $this->peg_currPos++;
          } else {
            $s2 = $this->peg_FAILED;
            if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c19); }
          }
        }
      } else {
        $s1 = $this->peg_c0;
      }
      if ($s1 !== $this->peg_FAILED) {
        $this->peg_reportedPos = $s0;
        $s1 = call_user_func($this->peg_c20,$s1);
      }
      $s0 = $s1;

      return $s0;
    }

    private function peg_parse_() {

      $s0 = $this->peg_c17;
      if (peg_regex_test($this->peg_c21, mb_substr($this->input, $this->peg_currPos, 1, "UTF-8"))) {
        $s1 = mb_substr($this->input, $this->peg_currPos, 1, "UTF-8");
        $this->peg_currPos++;
      } else {
        $s1 = $this->peg_FAILED;
        if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c22); }
      }
      while ($s1 !== $this->peg_FAILED) {
        $s0[] = $s1;
        if (peg_regex_test($this->peg_c21, mb_substr($this->input, $this->peg_currPos, 1, "UTF-8"))) {
          $s1 = mb_substr($this->input, $this->peg_currPos, 1, "UTF-8");
          $this->peg_currPos++;
        } else {
          $s1 = $this->peg_FAILED;
          if ($this->peg_silentFails === 0) { $this->peg_fail($this->peg_c22); }
        }
      }

      return $s0;
    }

  public function parse($input) {
    $arguments = func_get_args();
    $options = count($arguments) > 1 ? $arguments[1] : array();
    $this->cleanup_state();
    $this->input = $input;
    $old_regex_encoding = mb_regex_encoding();
    mb_regex_encoding("UTF-8");

    $this->peg_FAILED = new \stdClass;
    $this->peg_c0 = $this->peg_FAILED;
    $this->peg_c1 = "create";
    $this->peg_c2 = array( "type" => "literal", "value" => "create", "description" => "\"create\"" );
    $this->peg_c3 = "environment";
    $this->peg_c4 = array( "type" => "literal", "value" => "environment", "description" => "\"environment\"" );
    $this->peg_c5 = ";";
    $this->peg_c6 = array( "type" => "literal", "value" => ";", "description" => "\";\"" );
    $this->peg_c7 = function($value) {
        return [
          'type' => 'command',
          'name' => 'CreateEnvironment',
          'value' => $value
        ];
      };
    $this->peg_c8 = "using";
    $this->peg_c9 = array( "type" => "literal", "value" => "using", "description" => "\"using\"" );
    $this->peg_c10 = function($value) {
        return [
          'type' => 'command',
          'name' => 'UsingEnvironment',
          'value' => $value
        ];
      };
    $this->peg_c11 = "'";
    $this->peg_c12 = array( "type" => "literal", "value" => "'", "description" => "\"'\"" );
    $this->peg_c13 = function($name) {
        return $name;
      };
    $this->peg_c14 = "\"";
    $this->peg_c15 = array( "type" => "literal", "value" => "\"", "description" => "\"\\\"\"" );
    $this->peg_c16 = function($name) {
        return $name;
      };
    $this->peg_c17 = array();
    $this->peg_c18 = "/^[A-Za-z0-9_-]/";
    $this->peg_c19 = array( "type" => "class", "value" => "[A-Za-z0-9_\\-]", "description" => "[A-Za-z0-9_\\-]" );
    $this->peg_c20 = function($name) {
        return implode("", $name);
      };
    $this->peg_c21 = "/^[ \\t\\n\\r]/";
    $this->peg_c22 = array( "type" => "class", "value" => "[ \\t\\n\\r]", "description" => "[ \\t\\n\\r]" );

    $peg_startRuleFunctions = array( 'Command' => array($this, "peg_parseCommand") );
    $peg_startRuleFunction  = array($this, "peg_parseCommand");
    if (isset($options["startRule"])) {
      if (!(isset($peg_startRuleFunctions[$options["startRule"]]))) {
        throw new \Exception("Can't start parsing from rule \"" + $options["startRule"] + "\".");
      }

      $peg_startRuleFunction = $peg_startRuleFunctions[$options["startRule"]];
    }
    $peg_result = call_user_func($peg_startRuleFunction);

    mb_regex_encoding($old_regex_encoding);
    if ($peg_result !== $this->peg_FAILED && $this->peg_currPos === mb_strlen($input, "UTF-8")) {
      return $peg_result;
    } else {
      if ($peg_result !== $this->peg_FAILED && $this->peg_currPos < mb_strlen($input, "UTF-8")) {
        $this->peg_fail(array("type" => "end", "description" => "end of input" ));
      }

      throw $this->peg_buildException(null, $this->peg_maxFailExpected, $this->peg_maxFailPos);
    }
  }

};