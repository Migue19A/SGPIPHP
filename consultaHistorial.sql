select (upper("Nombre") || upper("ApellidoP") || upper("ApellidoM")) as nombre_completo,  from colaboradordocente colDoc 
inner join usuario usu on colDoc."Docente_noPersonal" = usu."NoPersonal" inner join docente doc 
on colDoc."Docente_noPersonal" = doc."noPersonal"
where "Proyecto_FolioProyecto" = 'PRE4'