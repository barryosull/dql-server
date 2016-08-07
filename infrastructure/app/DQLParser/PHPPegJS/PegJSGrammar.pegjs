
Command = CreateDatabase / DeleteDatabase / RenameDatabase / UsingDatabase / ShowDatabases / CreateDomain / DeleteDomain / RenameDomain / ShowDomains

/* Databases */
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

/* Domains */

CreateDomain = _ "create"i _ "domain"i _ value:QuotedName using:Using? ";" _
  {
    return [
      'using' => $using,
      'type' => 'modeling',
      'name' => 'CreateDomain',
      'value' => $value
    ];
  }

DeleteDomain = _ "delete"i _ "domain"i _ value:QuotedName using:Using? ";" _
  {
    return [
      'using' => $using,
      'type' => 'modeling',
      'name' => 'DeleteDomain',
      'value' => $value
    ];
  }

RenameDomain = _ "rename"i _ "domain"i _ old:QuotedName _ "to"i _ new:QuotedName using:Using? ";" _
  {
    return [
      'using' => $using,
      'type' => 'modeling',
      'name' => 'RenameDomain',
      'old' => $old,
      'new' => $new
    ];
  }

ShowDomains = _ "show"i _ "domains"i using:Using? ";" _
  {
    return [
      'using' => $using,
      'type' => 'modeling',
      'name' => 'ShowDomains'
    ];
  }

Using = _ "using"i _ "database"i _ name:QuotedName _
  {
    return $name; 
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