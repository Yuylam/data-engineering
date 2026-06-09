#include <iostream>
#include "SimpleCalc.h"
using namespace std;

SimpleCalc::SimpleCalc(int X, int Y){
    x = X;
    y = Y;
}

void SimpleCalc::setX(int X){
    x = X;
}
void SimpleCalc::setY(int Y){
    y = Y;
}

int SimpleCalc::getX(){
    return x;
}
int SimpleCalc::getY(){
    return y;
}

int SimpleCalc::addition() const{
    return x + y;
}
int SimpleCalc::subtraction() const{
    return x - y;
}
int SimpleCalc::multiplication() const{
    return x * y;
}
double SimpleCalc::division() const{
    return static_cast <double> (x) / y;
}
