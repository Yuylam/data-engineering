// Lam Yoke Yu
// A23CS0233
// 14 Dec 2023
// Programming Technique I Section 2

#include <iostream>
#include <iomanip>
#include <string>
using namespace std;

void dispStatus(int);
void getInput(int &, int &, int &, int &);
void dispOutput(int);
double calcAverage(int, int);

int main()
{
	int activeCases,	// Number of active cases
		totalCases,
		newCases,
		totalDeath,
		totalRecovered,
		highActive = 0,
		numState = 0,
		totalActive = 0;
	
	char end;
		
	double average;
	
	string state,
			highState;
	
	do 
	{
		cout << "\n<<<<<<<<<<<<<< DATA >>>>>>>>>>>>>\n";
	
		cout << left << setw(15) << "State name" << ": ";
		cin >> state;
		numState ++;
		
		getInput (totalCases, newCases, totalDeath, totalRecovered);
		
		activeCases = totalCases + newCases - totalDeath - totalRecovered;
		while (activeCases < 0){
			// Active cases must be 0 or more
			cout << "There are some mistakes in the data, please re-enter\n";
			getInput (totalCases, newCases, totalDeath, totalRecovered);
			activeCases = totalCases + newCases - totalDeath - totalRecovered;
		}
		totalActive += activeCases;
		
		if (activeCases > highActive){
			highActive = activeCases;
			highState = state;
		}
		
		dispOutput(activeCases);
		cout << endl << "Press <ENTER> to continue...";
		cin.ignore();
	}
	while (cin.get() == '\n');
	
	average = calcAverage(totalActive, numState);
	
	cout << left << endl
	<< "<<<<<<<<< ACTIVE CASES >>>>>>>>>>\n"
	<< setw(8) << "Total" << ": " << totalActive << endl
	<< setw(8) << "Highest" << ": " << highActive << " (" << highState << ")\n"
	<< "Average for " << numState << " states: " << average; 
	
	
}

void dispStatus(int n)
{
	// n = Number od active cases
	string s;
	
	if (n > 40)
		s = "Red";
	else if (n > 20)
		s = "Orange";
	else if (n > 0)
		s = "Yellow";
	else
		s = "Green";
		
	cout << left 
	<< setw(15) << "Status"	<< ": " << s << " zone\n";
}

void getInput(int &tc, int &nc, int &td, int &tr)
{
	// Total cases
	cout << left;
	cout << setw(15) << "Total cases" << ": ";
	cin >> tc;
	while (tc < 0){		
		// Total cases must not be a negative number
		cout << "That is an invalid value, please re-enter\n";
		cout << setw(15) << "Total cases" << ": ";
		cin >> tc;
	}
	
	// New cases
	cout << setw(15) << "New cases" << ": ";
	cin >> nc;
	while (nc < 0){	
		// New cases must not be a negative number	
		cout << "That is an invalid value, please re-enter\n";
		cout << setw(15) << "New cases" << ": ";
		cin >> nc;
	}
	
	// Total death
	cout << setw(15) << "Total death" << ": ";
	cin >> td;
	while (td < 0 || td > (tc + nc)){
		// Total death must not be a negative number and must be less that tc + nc
		cout << "That is an invalid value, please re-enter\n";
		cout << setw(15) << "Total death" << ": ";
		cin >> td;
	}
	
	// Total recovered
	cout << setw(15) << "Total recovered" << ": ";
	cin >> tr;	
	while (tr < 0 || tr > (tc + nc)){
		// Total recovered must not be a negative number and must be less that tc + nc
		cout << "That is an invalid value, please re-enter\n";
		cout << setw(15) << "Total recovered" << ": ";
		cin >> tr;
	}
}

void dispOutput(int n)
{
	cout << endl << left
	<< "<<<<<<<<<<<<< SUMMARY >>>>>>>>>>>\n"
	<< setw(15) << "Active cases" << ": " << n << endl;
	dispStatus(n);
}

double calcAverage(int c, int s)
{
	return c / static_cast <int> (s);
}
