
Command = CreateDatabase / DeleteDatabase / RenameDatabase / UsingDatabase / ShowDatabases

CreateDatabase = _ "create"i _ "database"i _ value:QuotedName _ ";" _
  {
    return [
      'type' => 'modeling',
      'name' => 'CreateDatabase',
      'value' => $value
    ];
  }

DeleteDatabase = _ "delete"i _ "database"i _ value:QuotedName _ ";" _
  {
    return [
      'type' => 'modeling',
      'name' => 'DeleteDatabase',
      'value' => $value
    ];
  }

RenameDatabase = _ "rename"i _ "database"i _ old:QuotedName _ "to"i _ new:QuotedName _ ";" _
  {
    return [
      'type' => 'modeling',
      'name' => 'RenameDatabase',
      'old' => $old,
      'new' => $new
    ];
  }

UsingDatabase = _ "using"i _ "database"i _ value:QuotedName _ ";" _
  {
    return [
      'type' => 'modeling',
      'name' => 'UsingDatabase',
      'value' => $value
    ];
  }

ShowDatabases = _ "show"i _ "databases"i _ ";" _
  {
    return [
      'type' => 'modeling',
      'name' => 'ShowDatabases'
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