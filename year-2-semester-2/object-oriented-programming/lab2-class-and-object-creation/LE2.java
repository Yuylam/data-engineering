public class LE2 {
    public static void main(String[] args) {
        // Question 1
        System.out.println("Question 1");

        Employee e1 = new Employee();
        e1.setEmpNum(101);
        e1.setEmpName("Ali");
        System.out.println("Employee Number: " + e1.getEmpNum());
        System.out.println("Employee Name: " + e1.getEmpName());

        System.out.println("\nQuestion 2: No Output");

        // Question 3
        System.out.println("\nQuestion 3");

        Book b1 = new Book("Java 101", "John Doe");
        b1.display();

        System.out.println("\nQuestion 4: No Output");
        System.out.println("\nQuestion 5: No Output");

        // Question 6
        System.out.println("\nQuestion 6");

        new User();
        new User();
        System.out.println("Total Users: " + User.getUserCount());

        // Question 7
        System.out.println("\nQuestion 7");
        Employee e = new Employee();
        e.setSalary(5000);
        System.out.println("Salary: " + e.getSalary());
    }
  }
  

// Class for Question 1 and Question 7
class Employee {
    // Question 1 Attributes and Methods
    // TODO: Add fields
    private int empNum;
    private String empName;

    // TODO: Add setter and getter methods
    public void setEmpNum(int n){
        empNum = n;
    }
    public void setEmpName(String n){
        empName = n;
    }
    public int getEmpNum(){
        return empNum;
    }
    public String getEmpName(){
        return empName;
    }

    // Question 7 Attributes and Methods
    // TODO: Make salary private
    private double salary;

    // TODO: Write setSalary() and getSalary() methods
    public void setSalary(double s){
        salary = s;
    }

    public double getSalary(){
        return salary;
    }
}

// Classes for Question 2
class Car {
    // TODO: Declare two private instance variables (brand and year)
    private String brand;
    private int year;

    // TODO: Create setter for brand
    public void setBrand(String b){
        brand = b;
    }

    // TODO: Create getter for year
    public int getYear(){
        return year;
    }
}

// Classes for Question 3
class Book {
    private String title;
    private String author;

    // TODO: Add a constructor
    public Book(String t, String a){
        title = t;
        author = a;
    }

    public void display() {
        System.out.println("Title: " + title);
        System.out.println("Author: " + author);
    }
}

// Classes for Question 4
class Student {
    private String name;
    private int age;

    // TODO: Implement setter for name
    public void setName(String n){
        name = n;
    }

    // TODO: Implement getter for age
    public int getName(){
        return age;
    }
}

// Classes for Question 5
class Message {
    // TODO: Write a method display() that prints "Hello!"
    public void display(){
        System.out.println("Hello!");
    }
    // TODO: Overload display(String msg) to print "Message: msg"
    public void display(String msg){
        System.out.println("Message: " + msg);
    }
}

// Classes for Question 6
class User {
    // TODO: Declare a static counter variable
    private static int counter = 0;

    public User() {
        // TODO: Increment counter
        counter++;
    }

    public static int getUserCount() {
        // TODO: Return counter
        return counter;
    }
}