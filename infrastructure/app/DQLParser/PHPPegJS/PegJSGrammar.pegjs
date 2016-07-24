
Command = CreateDatabase / UsingDatabase 

CreateDatabase = _ "create" _ "database" _ value:QuotedName _ ";" _
  {
    return [
      'type' => 'command',
      'name' => 'CreateDatabase',
      'value' => $value
    ];
  }

UsingDatabase = _ "using" _ "database" _ value:QuotedName _ ";" _
  {
    return [
      'type' => 'command',
      'name' => 'UsingDatabase',
      'value' => $value
    ];
  }

QuotedName = SingleQuotedName / DoubleQuotedName

SingleQuotedName = "'" name:Name "'"
  {
    return $name; 
  }

DoubleQuotedName = "\"" name:Name "\""
  {
    return $name;
  }

Name = name:[A-Za-z0-9_-]+
  {
    return implode("", $name);
  }

_ = [ \t\n\r]*