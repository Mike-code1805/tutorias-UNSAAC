# tutorias-UNSAAC

Algorithm of distribution of students to their respective authors.

#### Use of bootstrap, PHP, HTML and CSS for the interface.

## Notes by Miguel Enrique Saca Accostupa

This steps are I have done by this project:

1. Creating the function to convert to array **csv_Array**.
2. Creation of the function to show the array **Imprimir**.
3. Creation of the function to subtract arrays of students and arrays of tutors **diferenciaAlumnos, diferenciaDocente**.
4. Creation of the function to order the list of registered teachers from those who do not have the academic position to those who do **ordenarListaDocentes** _the category of those in charge is: "PR-DE"_.
5. Creation of the function **transformarDistribuciónADiccionario** to create a dictionary with teachers and their tutors.
6. Creation of the function that determines the tutors that remain in the current semester **tutoresQueSeMantienen**.
7. Creation of the function that determines the new tutors for the current semester **tutoresNuevos**.
8. Creation of the function that determines the tutors of the distribution of the previous semester **tutoresAnteriorDistribucion**.
9. Creation of the function that determines the tutors who did not register in the current semester **tutoresQueDejanElSemestre**.
10. Creation of the function that determines tutors without a tutor for the current semester (those who, or their tutor has left them, are new entrants or have rejoined the semester) **alumnosSinTutor**.
11. Creation of the function that determines new entrants **alumnosCachimbos**.
12. Creation of the function that determines the reincorporated students **alumnosRegulares**.
13. Creation of the function that adds the new tutors to the dictionary of tutors and tutored **agregarTutorAlDiccionario**.
14. Creation of the function that orders the tutors in the dictionary, giving it the format of those who do not have a position to those who do. **ordenarDiccionarioDistribucion**.
15. Creation of the function that determines the number of tutors for each tutor in order of certain positions (this function determines a balanced and fair distribution limit of how many tutors will correspond to each tutor) **cantidadAlumnosTutor**.
16. Creation of the function that distributes and gives the dictionary format to the tutors with their tutors (those who rejoin are added one by one jumping from tutors and new entrants are added in block until the tutor has no space available) **distribuirTutoresTutorados**.
