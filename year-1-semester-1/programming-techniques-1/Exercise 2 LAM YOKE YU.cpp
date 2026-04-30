// Lam Yoke Yu A23CS0233
// 01/11/2023
#include <iostream>
using namespace std;

void set1();
void set4();

int main ()
{
	cout << "Set 1\n";
	set1();
	
	cout << "\n\nSet 4\n";
	set4();
	
	return 0;
}

// Set 1
// Reads an integer number
// Calculate sum of digits
// Sum of digit multiple of 3 / 4 / 5

void set1 ()
{
    char x[10];
    int sum = 0,
        remainder,
        index = 0;

    bool mul3, mul4, mul5;
	
	// Get integer
    cout << "Enter an integer number: ";
    cin >> x;
    
    // Get and print sum of integer
    do{
    	if (index)
    		cout << " + ";
    	
    	cout << x[index];
    	sum += x[index] - 48;	// Character stored in ASCII Decimal, 48 is subtracted to get the actual value
    	index ++;
	}
	while (x[index]);
	
	cout << " = " << sum << endl;
	
	// Get and print factors
	mul3 = sum % 3;
	mul4 = sum % 4;
	mul5 = sum % 5;
	
	if (!mul3 || !mul4 || !mul5)
		cout << sum << " is the multiple of ";
	
	if (!mul3 && !mul4 && !mul5)	cout << "3, 4 and 5";
	else if (!mul3 && !mul4)		cout << "3 and 4";
	else if (!mul3 && !mul5)		cout << "3 and 5";
	else if (!mul4 && !mul5)		cout << "4 and 5";
	else if (!mul3) 				cout << "3";
	else if (!mul4) 				cout << "4";
	else if (!mul5) 				cout << "5";
}

// Set 4
// Reads an integer number
// Calculate product of digits
// Determine if the product is even or odd
// Sum of digit multiple of 3 / 5

void set4()
{
	char x[10];
    int product = 1,
        remainder,
        index = 0;

    bool mul3, mul5;

	// Get integer
    cout << "Enter an integer number: ";
    cin >> x;
    
    // Get and print product of integer
    do{
    	if (index)
    		cout << " * ";
    		
    	cout << x[index];
    	
    	product *= x[index] - 48;	// Character stored in ASCII Decimal, 48 is subtracted to get the actual value
    	index ++;
	}
	while (x[index]);
	
	cout << " = " << product << endl;
	
	// Determine and print odd or even
	if (product % 2)
		cout << product << " is odd number ";
	else 
		cout << product << " is even number ";
	
	// Get and print factors
	mul3 = product % 3;
	mul5 = product % 5;
	
	if (!mul3 || !mul5)
		cout << "& multiple of ";
		
	if (!mul3 && !mul5)	cout << "3 and 5";
	else if (!mul3) 	cout << "3";
	else if (!mul5) 	cout << "5";
}
