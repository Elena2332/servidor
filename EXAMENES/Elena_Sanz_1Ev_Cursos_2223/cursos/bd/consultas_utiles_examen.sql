Consulta para subir precios

	Update bdcursos.cursos set cursos.precio=(cursos.PRECIO *(1+(YY/100))) WHERE cursos.ID_CURSO in (select id_curso from (select id_curso from cursos, temas where cursos.id_tema=temas.id_tema and temas.categoria=’XXXX’) as cursos);

Consulta para bajar precios

	Update bdcursos.cursos set cursos.precio=(cursos.PRECIO *(1-(YY/100))) WHERE cursos.ID_CURSO in (select id_curso from (select id_curso from cursos, temas where cursos.id_tema=temas.id_tema and temas.categoria=’XXXX’) as cursos);

Consulta para obtener curso, edificio, aula y asistentes
	select cursos.Id_curso as curso ,edificios.nombre as edificio,aulas.ID_AULA as aula,temas.TEMA as tema , cursos.asistentes as asistentes 
	from cursos, temas, aulas, edificios where cursos.id_tema=temas.ID_TEMA 
	and cursos.ID_AULA=aulas.ID_AULA and aulas.id_edificio=edificios.id_edificio
	and DATE_FORMAT(dia, "%Y-%m-%d") = DATE_FORMAT(sysdate(), "%Y-%m-%d")
	order by tema desc ;
