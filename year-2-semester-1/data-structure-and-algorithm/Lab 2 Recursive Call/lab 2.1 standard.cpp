#include <iostream>
using namespace std;

int powerOfTwo(int n, int m = -1){
    n = abs(n);
    
    if(m == -1){
        m = n;
    }
    if (m == 1){
        return n;
    }
    return n + powerOfTwo(n, m - 1);
}

int main(){
    int n;
    cin >> n;
    cout << powerOfTwo(n);
}