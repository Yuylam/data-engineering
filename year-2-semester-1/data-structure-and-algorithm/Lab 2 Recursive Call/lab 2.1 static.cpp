#include <iostream>
using namespace std;

int powerOfTwo(int n){
    // Ensure n is a positive integer
    n = abs(n);

    static int count = n;
    count --;

    if (count == 0){
        return n;
    }
    return n + powerOfTwo(n);
}

int main(){
    int n;
    cin >> n;
    cout << powerOfTwo(n);
}