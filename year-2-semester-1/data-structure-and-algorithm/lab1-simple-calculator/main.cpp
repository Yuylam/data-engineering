#include <iostream>
#include "SimpleCalc.h"
using namespace std;

int main(){
    int x, y;
    cout << "Integer #1: ";
    cin >> x;

    cout << "Integer #2: ";
    cin >> y;

    SimpleCalc calc(x, y);
    cout
    << "The result of addition is: " << calc.addition() << endl
    << "The result of subtraction is: " << calc.subtraction() << endl
    << "The result of multiplication is: " << calc.multiplication() << endl;
    if (calc.getY()){
        cout << "The result of division is: " << calc.division() << endl;
    }
    else
        cout << "Error: Division by zero!" << endl;
    return 0;
}