/**
 * @brief Demonstration of templates specialization in function and class scope
 * @author Rafal Jaskurzynski
 * @date 27.03.2016
 */

#include <iostream>

using namespace std;

// 1. Standard template
template< class T, class U >
void function( T a, U b )
{
    cout << "1. " << __PRETTY_FUNCTION__ << endl;

}

// 2. Specialized template
template< >
void function< int , int >( int a, int b )
{
    cout << "2. " << __PRETTY_FUNCTION__ << endl;
}

// 3. Overloaded template
template< class T, class U >
void function(T a, U* b)
{
    cout << "3. " << __PRETTY_FUNCTION__ << endl;
}

// 4. Specialized overloaded template. Never called: 3 used instead.
template< class T, class U >
void function(float a, float* b)
{
    cout << "4. " << __PRETTY_FUNCTION__ << endl;
}

// 5. Partial specialization: not allowed ( compilation error)
/*
template< class T>
void function<int, T >(int a, T b )
{
    cout << "5." << __PRETTY_FUNCTION__ << endl;
}
*/

// 6. Function overload. (Not specialization)
template< class T>
void function( bool a, T b )
{
    cout << "6. " << __PRETTY_FUNCTION__ << endl;
}

// 7. Standard template
template< class T, class U>
class Class
{
public:
    Class( )
    {
        cout << "7. " << __PRETTY_FUNCTION__ << endl;
    }
};

// 8. Specialized template
template< >
class Class< int, int >
{
public:
    Class( )
    {
        cout << "8. " << __PRETTY_FUNCTION__ << endl;
    }
};

// 9. Partial template specialization
template< class T >
class Class<int, T >
{
public:
    Class( )
    {
        cout << "9. " << __PRETTY_FUNCTION__ << endl;
    }
};

int main()
{
    bool _bool;
    float _float;
    int _int;

    // Function calls
    function( _int, _bool );     // 1.

    function(_int, _int);        // 2.

    function( _float, &_float ); // 3.

    function( _bool, _int );     // 6.

    // Class calls
    Class< bool, bool > a;       // 7.

    Class< int, int > b;         // 8.

    Class< int, bool > c;        // 9.

    /** Full output
     * 1. void function(T, U) [with T = int; U = bool]
     * 2. void function(T, U) [with T = int; U = int]
     * 3. void function(T, U*) [with T = float; U = float]
     * 6. void function(bool, T) [with T = int]
     * 7. Class<T, U>::Class() [with T = bool; U = bool]
     * 8. Class<int, int>::Class()
     * 9. Class<int, T>::Class() [with T = bool]
    */

    return 0;
}

