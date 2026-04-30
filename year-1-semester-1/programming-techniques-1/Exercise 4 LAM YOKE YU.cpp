// Exericise 4
// Lam Yoke Yu
// A23CS0233

#include <iostream>
#include <iomanip>
#include <fstream>
#include <string>
using namespace std;

int readFile(string, double[], double);
void computeC(const double[], double[], int);
double average(const double[], int);
char grade(double, int[]);
void writeFile(const double[], const double[], const char[], int);


int main(){
	double dataF[50], dataC[50], tempData, ave;
	int gradNum[3] = {0, 0, 0}, 	// 0 - High, 1 - Medium, 2 - Low
		size;						// Size of data
	char dataGrad[50];
	string inputFile = "FarenheitData.txt";
	
	// Read file and get the size of data
	size = readFile(inputFile, dataF, tempData);

	// Calculate the respective celcius
	computeC(dataF, dataC, size);
	
	// Calculate the average
	ave = average(dataC, size);
	
	// Get the grade for each temperature
	for (int i = 0; i < size; i++){
		char tempGrade = grade(dataC[i], gradNum);
		dataGrad[i] = tempGrade;
	}
	
	// Save the report in a txt file
	writeFile(dataF, dataC, dataGrad, size);
	
	// Print output on screen
	cout 
	<< "Average of the temperature in Celcius: " << fixed << setprecision(1) << ave << endl
	<< "Number of high temperature: " << gradNum[0] << endl
	<< "Number of medium temperature: " << gradNum[1] << endl
	<< "Number of low temperature: " << gradNum[2] << endl;
	
	return 0;
}

int readFile(string inputFile, double dataF[], double tempData){
	int size;
	ifstream infile(inputFile.c_str());
	
	if (!infile){
		cout << "There an error when opening the file.\n";
	}
	else{
		for (int i = 0; infile >> tempData; i++){
			dataF[i] = tempData;
			size ++;
		}
	
		infile.close();
	}
	
	return size;
}

void computeC(const double dataF[], double dataC[], int size){
	for (int i = 0; i < size; i++)
		dataC[i] = 5.0 / 9.0 * (dataF[i] - 32);
}

double average(const double dataC[], int size){
	double sum = 0;
	for (int i = 0; i < size; i++)
		sum += dataC[i];
		
	return sum / size;
}

char grade(double c, int gradNum[]){
	if (c >= 35){
		gradNum[0]++;
		return 'H';
	}
	else if (c >= 20){
		gradNum[1]++;
		return 'M';
	}
	else{
		gradNum[2]++;
		return 'L';
	}
}

void writeFile(const double dataF[], const double dataC[], const char dataGrad[], int size){
	ofstream outfile("CelsiusData.txt");
	
	outfile 
	<< "C(Celcius)" << "     " << "F(Farenheit)" << "     " << "Description" << endl
	<< "==========" << "     " << "============" << "     " << "===========" << endl;
	
	for (int i = 0; i < size; i++){
		outfile
		<< fixed << setprecision(2) 
		<< setw(7) << dataC[i] 
		<< setw(15) << dataF[i]
		<< setw(13) << dataGrad[i] << endl;
	}
	outfile.close();
}
