# tutorias-UNSAAC

Algorithm of distribution of students to their respective authors.

#### Use of bootstrap, PHP, HTML and CSS for the interface.

## Notes by Miguel Enrique Saca Accostupa

This steps are I have done by this project:

01. Created the csv_Array function to convert CSV data to an array.
02. Created the Imprimir function to display the array data.
03. Created the diferenciaAlumnos and diferenciaDocente functions to subtract student and tutor arrays respectively.
04. Created the ordenarListaDocentes function to order the list of registered teachers from those who do not have the academic position to those who do. The category of those in charge is: "PR-DE".
05. Created the transformarDistribuciónADiccionario function to create a dictionary with teachers and their tutors.
06. Created the tutoresQueSeMantienen function to determine the tutors that remain in the current semester.
07. Created the tutoresNuevos function to determine the new tutors for the current semester.
08. Created the tutoresAnteriorDistribucion function to determine the tutors from the previous semester's distribution.
09. Created the tutoresQueDejanElSemestre function to determine the tutors who did not register in the current semester.
10. Created the alumnosSinTutor function to determine students without a tutor for the current semester (those who, or their tutor has left them, are new entrants or have rejoined the semester).
11. Created the alumnosCachimbos function to determine new entrants.
12. Created the alumnosRegulares function to determine the reincorporated students.
13. Created the agregarTutorAlDiccionario function to add new tutors to the dictionary of tutors and tutored.
14. Created the ordenarDiccionarioDistribucion function to order the tutors in the dictionary, giving it the format of those who do not have a position to those who do.
15. Created the cantidadAlumnosTutor function to determine the number of tutors for each tutor in order of certain positions. This function determines a balanced and fair distribution limit of how many tutors will correspond to each tutor.
16. Created the distribuirTutoresTutorados function to distribute and give the dictionary format to the tutors with their tutors. Those who rejoin are added one by one jumping from tutors, and new entrants are added in block until the tutor has no space available.**distribuirTutoresTutorados**.
