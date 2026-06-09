import java.util.*;

public class ArrayLab {

    public static void main(String[] args) {
        PartA();
        PartB();

        System.out.println("<<<<< Part C: Create & Use Methods >>>>>");
        System.out.print("*** Question 7 ***\n");
        Scanner input = new Scanner(System.in);

        // 1D array for student scores
        int[] scores = new int[5];
        for (int i = 0; i < scores.length; i++) {
            System.out.print("Enter score " + (i + 1) + ": ");
            scores[i] = input.nextInt();
        }

        // Question 7
        int highestScore = findHighestScore(scores);
        System.out.println("Highest Score: " + highestScore + "\n");

        // 2D array for marks of 3 students and 3 subjects
        int[][] marks = {
            {85, 78, 90},
            {88, 92, 79},
            {75, 80, 85}
        };

        // Question 9;
        System.out.print("*** Question 9 ***\n");
        int sum = sumSubjectMarks(marks);
        System.out.println("Sum Subject Marks: " + sum + "\n");

        // ArrayList of subjects
        ArrayList<String> subjects = new ArrayList<>();
        subjects.add("Math");
        subjects.add("Science");
        subjects.add("English");

        // Array of Student objects
        Student[] students = new Student[3];
        students[0] = new Student("Ali", 20);
        students[1] = new Student("Siti", 21);
        students[2] = new Student("Raj", 19);

        // Display all student names
        System.out.print("*** Question 8 ***\n");
        printStudentInfo(students);

        input.close();
    }

    public static void PartA(){
        System.out.print("<<<<< Part A: Spot the Errors >>>>>\n");
        // Question 1
        System.out.print("*** Question 1 ***\n");
        System.out.print("\tdouble gpa[] = new double(4);\n");
        System.out.print("Answer:\n");
        System.out.print("\tdouble gpa[] = new double[4];\n\n");
        double gpa[] = new double[4];
        
        // Question 2
        System.out.print("*** Question 2 ***\n");
        System.out.print("\tint[] points;\r\n" +
                        "\tpoints = {90, 85, 88};\n");
        System.out.print("Answer:\n");
        System.out.print("\tint[] points = {90, 85, 88};\n\n");
        int[] points = {90, 85, 88};

        // Question 3
        System.out.print("*** Question 3 ***\n");
        System.out.print("\tpublic static void printTotal(int... values, String title) { \r\n" + //
                        "\t\t// ...\r\n" + //
                        "\t}\n");
        System.out.print("Answer:\n");
        System.out.print("\tpublic static void printTotal(String title, int... values) { \r\n" + //
                        "\t\t// ...\r\n" + //
                        "\t}\n\n");
    }

    // Question 3
    public static void printTotal(String title, int... values) {
        //...
    }

    public static void PartB(){
        // Part B
        System.out.println("<<<<< Part B: Write Short Array Declarations >>>>>");
        // Question 4
        System.out.println("*** Question 4 ****");
        System.out.println("\tint [][] matrix = {{1, 2, 3}, {4, 5, 6}, {7, 8, 9}};\n");
        int [][] matrix = {{1, 2, 3},
                            {4, 5, 6},
                            {7, 8, 9}};
        
        // Question 5
        System.out.println("*** Question 5 ****");
        System.out.println("\tArrayList<Double> grades = new ArrayList<Double>();\n");
        ArrayList<Double> grades = new ArrayList<Double>();

        // Question 6
        System.out.println("*** Question 6 ****");
        printAverage(new int[]{10, 20, 30, 40});
    }

    public static void printAverage(int[] a){
        System.out.print("Array: ");
        int sum = 0;
        int count = 0;
        for(int x : a){
            System.out.print(x + " ");
            sum += x;
            count++;
        }
        System.out.println("\nAverage: " + sum / count + "\n");
    }

    public static int findHighestScore(int[] scores){
        int max = scores[0];

        for (int x : scores){
            if (x > max){
                max = x;
            }
        }
        return max;
    }

    public static void printStudentInfo(Student[] arr) {
        for(Student s : arr){
            System.out.println("Student: " + s.getName() + ", Age: " + s.getAge());
        }
    }

    public static int sumSubjectMarks(int[][] marks){
        int sum = 0;
        for(int[] i : marks){
            for(int j : i){
                sum += j;
            }
        }
        return sum;
    }
}

// Student class
class Student {
    private String name;
    private int age;

    public Student(String name, int age) {
        this.name = name;
        this.age = age;
    }

    public String getName() { return name; }
    public int getAge() { return age; }
}
