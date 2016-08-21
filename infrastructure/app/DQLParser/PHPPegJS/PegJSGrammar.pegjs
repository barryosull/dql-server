
Command = DatabaseCommand / DomainCommand / ContextCommand

DatabaseCommand = command:PartialDatabaseCommand _ ";" _
  {
    return $command;
  }

PartialDatabaseCommand = CreateDatabase / DeleteDatabase / RenameDatabase / ShowDatabases / UsingDatabase

/* Databases */
CreateDatabase = _ "create"i _ "database"i _ value:QuotedName 
  {
    return [
      'type' => 'command',
      'name' => 'CreateDatabase',
      'value' => $value
    ];
  }

DeleteDatabase = _ "delete"i _ "database"i _ value:QuotedName 
  {
    return [
      'type' => 'command',
      'name' => 'DeleteDatabase',
      'value' => $value
    ];
  }

RenameDatabase = _ "rename"i _ "database"i _ old:QuotedName _ "to"i _ new:QuotedName
  {
    return [
      'type' => 'command',
      'name' => 'RenameDatabase',
      'old' => $old,
      'new' => $new
    ];
  }

UsingDatabase = _ "using"i _ "database"i _ value:QuotedName 
  {
    return [
      'type' => 'controllerCommand',
      'name' => 'UsingDatabase',
      'value' => $value
    ];
  }

ShowDatabases = _ "show"i _ "databases"i
  {
    return [
      'type' => 'query',
      'name' => 'ShowDatabases'
    ];
  }

/* Domains */

DomainCommand = command:PartialDomainCommand using:UsingDatabase? _ ";" _
  {
    $command['using'] = isset($using) ? $using['value'] : null; 
    return $command;
  }

PartialDomainCommand = CreateDomain / DeleteDomain / RenameDomain / ShowDomains/ ForDomain

CreateDomain = _ "create"i _ "domain"i _ value:QuotedName
  {
    return [
      'type' => 'command',
      'name' => 'CreateDomain',
      'value' => $value
    ];
  }

DeleteDomain = _ "delete"i _ "domain"i _ value:QuotedName
  {
    return [
      'type' => 'command',
      'name' => 'DeleteDomain',
      'value' => $value
    ];
  }

RenameDomain = _ "rename"i _ "domain"i _ old:QuotedName _ "to"i _ new:QuotedName
  {
    return [
      'type' => 'command',
      'name' => 'RenameDomain',
      'old' => $old,
      'new' => $new
    ];
  }

ShowDomains = _ "show"i _ "domains"i 
  {
    return [
      'type' => 'query',
      'name' => 'ShowDomains'
    ];
  }

ForDomain = _ "for"i _ "domain"i _ value:QuotedName
  {
    return [
      'type' => 'controllerCommand',
      'name' => 'ForDomain',
      'value' => $value
    ];
  }

/** Context commands */

ContextCommand = command:PartialContextCommand for:ForDomain using:UsingDatabase? _ ";" _
  {
    $command['using'] = isset($using) ? $using['value'] : null; 
    $command['for'] = isset($for) ? $for['value'] : null; 
    return $command;
  }

PartialContextCommand = CreateContext / DeleteContext / RenameContext / ShowContext/ InContext

CreateContext = _ "create"i _ "context"i _ value:QuotedName
  {
    return [
      'type' => 'command',
      'name' => 'CreateContext',
      'value' => $value
    ];
  }

DeleteContext = _ "delete"i _ "context"i _ value:QuotedName
  {
    return [
      'type' => 'command',
      'name' => 'DeleteContext',
      'value' => $value
    ];
  }

RenameContext = _ "rename"i _ "context"i _ old:QuotedName _ "to"i _ new:QuotedName
  {
    return [
      'type' => 'command',
      'name' => 'RenameContext',
      'old' => $old,
      'new' => $new
    ];
  }

ShowContext = _ "show"i _ "contexts"i 
  {
    return [
      'type' => 'query',
      'name' => 'ShowContext'
    ];
  }

InContext = _ "in"i _ "context"i _ value:QuotedName
  {
    return [
      'type' => 'controllerCommand',
      'name' => 'InContext',
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

Name = name:[A-Za-z0-9 ,_.-]*
  {
    return implode("", $name);
  }

_ = [ \t\n\r]*