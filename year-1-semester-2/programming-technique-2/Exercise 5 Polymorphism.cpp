
// Use this program template to answer Question 3

// Programming Technique II (SCSJ1023)
// Semester 1, 2019/2020

// Programming Technique II (SECJ1023)
// Semester 1, 2020/2021

// Exercise 3: Polymorphism and inheritance

// Write your name and your partner's name.
// Only one submission is required per pair
// Submit only the source code file.
// Use only one source code file for this exercise. However, class declaration and definition
//  must be separated within the same file.

//! Pair Programming - Members Names and Location
// Name 1: Goe Jie Ying
// Name 2: Lam Yoke Yu

#include <iostream>
#include <string>
#include <iomanip>
using namespace std;

//-------------------------------------------------------------------------------------------------------------
// Class declarations >> Student, Mentor, Coach, Support and Mentee
//-------------------------------------------------------------------------------------------------------------
// Class Student is fully given. Do nothing on this class.

class Student
{
protected:
    string name;

public:
    Student(string n = "");
    string getName() const;
    void setName(string n);
};

// Task 1(a): Declare the class Mentor.
class Mentor : public Student
{
protected:
    double cpa;

public:
    Mentor(string n, double c);
    virtual void edit();
    virtual void print();
};

// Task 1(b): Declare the class Coach.
class Coach : public Mentor
{
protected:
    string expertise;
public:
    Coach(string name, double cpa, string expertise);
    string getExpertise();
    void setExpertise(string);
    virtual void edit();
    virtual void print();
};

// Task 1(c): Declare the class Support.
class Support : public Mentor
{
protected:
    string phone;
public:
    Support(string name, double cpa, string phone);
    string getPhone();
    void setPhone(string);
    void edit();
    void print();
};

// Task 1(d): Declare the class Mentee.
class Mentee : public Student
{
protected:
    int level;
    Mentor *mentor;
public:
    Mentee(string name, int level);
    void assignMentor(Mentor *);
    void displayInfo();
};

//-------------------------------------------------------------------------------------------------------------
// Class definition >> Student
//-------------------------------------------------------------------------------------------------------------
// Class Student is given. Do nothing on this class.

Student::Student(string n) : name(n) {}
string Student::getName() const { return name; }
void Student::setName(string n) { name = n; }

//-------------------------------------------------------------------------------------------------------------
// Class definition >> Mentor
//-------------------------------------------------------------------------------------------------------------
// Task 2: Define all methods for the class Mentor.
Mentor::Mentor(string n, double c) : Student(n)
    { cpa = c; };

void Mentor::edit(){
    // To edit mentor information by the user
};

void Mentor::print(){
    // To print the mentor's name and CPA
    cout 
    << setw(20) << "Mentor's Name" << ": " << name << endl
    << setw(20) << "Mentor's CPA" << ": " << cpa << endl;
};

//-------------------------------------------------------------------------------------------------------------
// Class definition >> Coach
//-------------------------------------------------------------------------------------------------------------
// Task 3:  Define all methods for the class Coach.
Coach::Coach(string name, double cpa, string e) : Mentor(name, cpa) 
    { expertise = e; }

string Coach::getExpertise()
    { return expertise; }

void Coach::setExpertise(string e)
    { expertise = e; }

void Coach::edit(){
    // To edit mentor's expertise by the user
    cout << "You can only edit the mentor's expertise\n\n";
    cout << "Enter new expertise => ";
    getline(cin, expertise);
}

void Coach::print(){
    // To print the mentor's name, cpa and expertise
    cout << setw(20) << "Mentoring type" << ": " << "Coach-based\n";
    Mentor::print();
    cout << setw(20) << "Mentor's Expertise" << ": " << expertise << endl;
}

//-------------------------------------------------------------------------------------------------------------
// Class definition >> Support
//-------------------------------------------------------------------------------------------------------------
// Task 4: Define all methods for class Support.
Support::Support(string name, double cpa, string p) : Mentor(name, cpa) 
    { phone = p; }

string Support::getPhone()
    { return phone; }

void Support::setPhone(string p)
    { phone = p; }

void Support::edit(){
    // To edit mentor's phone number by the user
    cout << "You can only edit the mentor's phone number\n\n";
    cout << "Enter new phone number => ";
    getline(cin, phone);
}

void Support::print(){
    // To print the mentor's name, cpa and phone
    cout << setw(20) << "Mentoring type" << ": " << "Support-based\n";
    Mentor::print();
    cout << setw(20) << "Mentor's Phone" << ": " << phone << endl;
    
}

//-------------------------------------------------------------------------------------------------------------
// Class definition >> Mentee
//-------------------------------------------------------------------------------------------------------------
// Task 5: Define all methods for the class Mentee.
Mentee::Mentee(string name, int l):Student(name){
    level = l;
    mentor = nullptr;
}

void Mentee::assignMentor(Mentor *m)
    { mentor = m; }

void Mentee::displayInfo(){
    // To display the mentee's information including:
    //     name and level, 
    //     i.e. either a coach mentor or a support mentor.
    //     If no mentor is assigned yet, then this method will print a 
    //     message indicating that.
    cout
    << "Mentee's Name  : " << name << endl
    << "Mentee's Level : " << level << endl;
    if(mentor){
        mentor->print();
    }
    else{
        cout << "** No mentor yet **\n";
    }
}

//-------------------------------------------------------------------------------------------------------------
// The menu function is given
int menu()
{
    cout << endl;
    cout << "========== Menu ==========" << endl;
    cout << "1. Select first mentor" << endl;
    cout << "2. Select second mentor" << endl;
    cout << "3. Display selected mentor" << endl;
    cout << "4. Edit selected mentor" << endl;
    cout << "5. Assign selected mentor to mentee" << endl;
    cout << "6. Unassign mentor from mentee" << endl;
    cout << "7. Display all mentees" << endl;
    cout << "9. Exit" << endl;
    cout << endl;

    int choice;
    cout << "Choose an operation [1-7, or 9] => ";
    cin >> choice;

    cin.ignore();
    cout << endl;

    return choice;
}

//-------------------------------------------------------------------------------------------------------------
// The Main Function
//-------------------------------------------------------------------------------------------------------------

int main()
{
    // Given an array of mentees.
    Mentee mentees[3] = {Mentee("Abdul Samad", 2),
                         Mentee("Nurdiana", 1),
                         Mentee("Nurazlan", 2)};
    int index; // the index of mentee that the user wants to work on. To be used in case 5 and case 6

    // Given two mentors
    Coach mentor1("Ahmad Kamal", 3.87, "Programming");
    Support mentor2("Siti Aminah", 3.98, "0123456789");

    // Task 6(a): Declare a pointer to be used for pointing to a coach-mentor or a support-mentor.
    //            Initialize this pointer to point to any of the mentors (mentor1 or mentor2).
    Mentor *mentorptr = &mentor1;

    int operation; // menu operation chosen by the user

    // Output formatting
    cout << left;

    operation = menu();

    while (operation != 9)
    {
        switch (operation)
        {
        case 1: // Task 6(b): Select the first mentor (mentor1), as the current mentor.
            cout << "First mentor is selected" << endl;
            mentorptr = &mentor1;
            break;

        case 2: // Task 6(c): Select the second mentor (mentor2), as the current mentor.
            cout << "Second mentor is selected" << endl;
            mentorptr = &mentor2;
            break;

        case 3: // Task 6(d): Display the name of the selected mentor.
            cout << "Current selected mentor: " << mentorptr->getName() << endl;
            break;

        case 4: // Task 6(e): Edit the selected mentor.
            cout << "Mentor's Information:\n";
            mentorptr->print();
            cout << endl;
            mentorptr->edit();
            break;

        case 5: // Task 6(f): Assign the selected mentor to a mentee.
            cout << "Enter the index of mentee to assign with the current mentor => ";
            cin >> index;
            mentees[index].assignMentor(mentorptr);
            break;

        case 6: // Task 6(g): Unassign the mentor from a mentee.
            cout << "Enter the index of mentee to remove its mentor => ";
            cin >> index;
            mentees[index].assignMentor(nullptr);
            break;

        case 7: // Task 6(h): Display the info for each of the mentees.
            cout << "List of mentees:" << endl;
            int i = 1;
            for(auto &mentee : mentees){
                cout << "#" << i++ << endl;
                mentee.displayInfo();
                cout << endl;
            }
            break;

        } // switch

        operation = menu();

    } // while

    system("pause"); // You may want to comment out this line (system("pause")) if you are using Dev C++
    return 0;
}
