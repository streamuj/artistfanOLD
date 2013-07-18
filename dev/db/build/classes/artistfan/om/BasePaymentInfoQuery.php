<?php


/**
 * Base class that represents a query for the 'payment_info' table.
 *
 * 
 *
 * @method     PaymentInfoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     PaymentInfoQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     PaymentInfoQuery orderByRoutingCode($order = Criteria::ASC) Order by the routing_code column
 * @method     PaymentInfoQuery orderByAccountNumber($order = Criteria::ASC) Order by the account_number column
 * @method     PaymentInfoQuery orderByHolderName($order = Criteria::ASC) Order by the holder_name column
 * @method     PaymentInfoQuery orderByAccountType($order = Criteria::ASC) Order by the account_type column
 * @method     PaymentInfoQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 * @method     PaymentInfoQuery orderByMailName($order = Criteria::ASC) Order by the mail_name column
 * @method     PaymentInfoQuery orderByMailAdd1($order = Criteria::ASC) Order by the mail_add1 column
 * @method     PaymentInfoQuery orderByMailAdd2($order = Criteria::ASC) Order by the mail_add2 column
 * @method     PaymentInfoQuery orderByMailCity($order = Criteria::ASC) Order by the mail_city column
 * @method     PaymentInfoQuery orderByMailState($order = Criteria::ASC) Order by the mail_state column
 * @method     PaymentInfoQuery orderByMailZip($order = Criteria::ASC) Order by the mail_zip column
 * @method     PaymentInfoQuery orderByPaypalId($order = Criteria::ASC) Order by the paypal_id column
 * @method     PaymentInfoQuery orderByPaypalApprovalKey($order = Criteria::ASC) Order by the paypal_approval_key column
 * @method     PaymentInfoQuery orderByPaypalInfo($order = Criteria::ASC) Order by the paypal_info column
 *
 * @method     PaymentInfoQuery groupById() Group by the id column
 * @method     PaymentInfoQuery groupByUserId() Group by the user_id column
 * @method     PaymentInfoQuery groupByRoutingCode() Group by the routing_code column
 * @method     PaymentInfoQuery groupByAccountNumber() Group by the account_number column
 * @method     PaymentInfoQuery groupByHolderName() Group by the holder_name column
 * @method     PaymentInfoQuery groupByAccountType() Group by the account_type column
 * @method     PaymentInfoQuery groupByPdate() Group by the pdate column
 * @method     PaymentInfoQuery groupByMailName() Group by the mail_name column
 * @method     PaymentInfoQuery groupByMailAdd1() Group by the mail_add1 column
 * @method     PaymentInfoQuery groupByMailAdd2() Group by the mail_add2 column
 * @method     PaymentInfoQuery groupByMailCity() Group by the mail_city column
 * @method     PaymentInfoQuery groupByMailState() Group by the mail_state column
 * @method     PaymentInfoQuery groupByMailZip() Group by the mail_zip column
 * @method     PaymentInfoQuery groupByPaypalId() Group by the paypal_id column
 * @method     PaymentInfoQuery groupByPaypalApprovalKey() Group by the paypal_approval_key column
 * @method     PaymentInfoQuery groupByPaypalInfo() Group by the paypal_info column
 *
 * @method     PaymentInfoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PaymentInfoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PaymentInfoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     PaymentInfoQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     PaymentInfoQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     PaymentInfoQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     PaymentInfo findOne(PropelPDO $con = null) Return the first PaymentInfo matching the query
 * @method     PaymentInfo findOneOrCreate(PropelPDO $con = null) Return the first PaymentInfo matching the query, or a new PaymentInfo object populated from the query conditions when no match is found
 *
 * @method     PaymentInfo findOneById(int $id) Return the first PaymentInfo filtered by the id column
 * @method     PaymentInfo findOneByUserId(int $user_id) Return the first PaymentInfo filtered by the user_id column
 * @method     PaymentInfo findOneByRoutingCode(string $routing_code) Return the first PaymentInfo filtered by the routing_code column
 * @method     PaymentInfo findOneByAccountNumber(string $account_number) Return the first PaymentInfo filtered by the account_number column
 * @method     PaymentInfo findOneByHolderName(string $holder_name) Return the first PaymentInfo filtered by the holder_name column
 * @method     PaymentInfo findOneByAccountType(int $account_type) Return the first PaymentInfo filtered by the account_type column
 * @method     PaymentInfo findOneByPdate(int $pdate) Return the first PaymentInfo filtered by the pdate column
 * @method     PaymentInfo findOneByMailName(string $mail_name) Return the first PaymentInfo filtered by the mail_name column
 * @method     PaymentInfo findOneByMailAdd1(string $mail_add1) Return the first PaymentInfo filtered by the mail_add1 column
 * @method     PaymentInfo findOneByMailAdd2(string $mail_add2) Return the first PaymentInfo filtered by the mail_add2 column
 * @method     PaymentInfo findOneByMailCity(string $mail_city) Return the first PaymentInfo filtered by the mail_city column
 * @method     PaymentInfo findOneByMailState(string $mail_state) Return the first PaymentInfo filtered by the mail_state column
 * @method     PaymentInfo findOneByMailZip(string $mail_zip) Return the first PaymentInfo filtered by the mail_zip column
 * @method     PaymentInfo findOneByPaypalId(string $paypal_id) Return the first PaymentInfo filtered by the paypal_id column
 * @method     PaymentInfo findOneByPaypalApprovalKey(string $paypal_approval_key) Return the first PaymentInfo filtered by the paypal_approval_key column
 * @method     PaymentInfo findOneByPaypalInfo(string $paypal_info) Return the first PaymentInfo filtered by the paypal_info column
 *
 * @method     array findById(int $id) Return PaymentInfo objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return PaymentInfo objects filtered by the user_id column
 * @method     array findByRoutingCode(string $routing_code) Return PaymentInfo objects filtered by the routing_code column
 * @method     array findByAccountNumber(string $account_number) Return PaymentInfo objects filtered by the account_number column
 * @method     array findByHolderName(string $holder_name) Return PaymentInfo objects filtered by the holder_name column
 * @method     array findByAccountType(int $account_type) Return PaymentInfo objects filtered by the account_type column
 * @method     array findByPdate(int $pdate) Return PaymentInfo objects filtered by the pdate column
 * @method     array findByMailName(string $mail_name) Return PaymentInfo objects filtered by the mail_name column
 * @method     array findByMailAdd1(string $mail_add1) Return PaymentInfo objects filtered by the mail_add1 column
 * @method     array findByMailAdd2(string $mail_add2) Return PaymentInfo objects filtered by the mail_add2 column
 * @method     array findByMailCity(string $mail_city) Return PaymentInfo objects filtered by the mail_city column
 * @method     array findByMailState(string $mail_state) Return PaymentInfo objects filtered by the mail_state column
 * @method     array findByMailZip(string $mail_zip) Return PaymentInfo objects filtered by the mail_zip column
 * @method     array findByPaypalId(string $paypal_id) Return PaymentInfo objects filtered by the paypal_id column
 * @method     array findByPaypalApprovalKey(string $paypal_approval_key) Return PaymentInfo objects filtered by the paypal_approval_key column
 * @method     array findByPaypalInfo(string $paypal_info) Return PaymentInfo objects filtered by the paypal_info column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BasePaymentInfoQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BasePaymentInfoQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'PaymentInfo', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new PaymentInfoQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    PaymentInfoQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof PaymentInfoQuery) {
			return $criteria;
		}
		$query = new PaymentInfoQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PaymentInfo|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = PaymentInfoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(PaymentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    PaymentInfo A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `ROUTING_CODE`, `ACCOUNT_NUMBER`, `HOLDER_NAME`, `ACCOUNT_TYPE`, `PDATE`, `MAIL_NAME`, `MAIL_ADD1`, `MAIL_ADD2`, `MAIL_CITY`, `MAIL_STATE`, `MAIL_ZIP`, `PAYPAL_ID`, `PAYPAL_APPROVAL_KEY`, `PAYPAL_INFO` FROM `payment_info` WHERE `ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new PaymentInfo();
			$obj->hydrate($row);
			PaymentInfoPeer::addInstanceToPool($obj, (string) $row[0]);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    PaymentInfo|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(PaymentInfoPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(PaymentInfoPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(PaymentInfoPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUserId(1234); // WHERE user_id = 1234
	 * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
	 * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
	 * </code>
	 *
	 * @see       filterByUser()
	 *
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(PaymentInfoPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(PaymentInfoPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the routing_code column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByRoutingCode('fooValue');   // WHERE routing_code = 'fooValue'
	 * $query->filterByRoutingCode('%fooValue%'); // WHERE routing_code LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $routingCode The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByRoutingCode($routingCode = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($routingCode)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $routingCode)) {
				$routingCode = str_replace('*', '%', $routingCode);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::ROUTING_CODE, $routingCode, $comparison);
	}

	/**
	 * Filter the query on the account_number column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAccountNumber('fooValue');   // WHERE account_number = 'fooValue'
	 * $query->filterByAccountNumber('%fooValue%'); // WHERE account_number LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $accountNumber The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByAccountNumber($accountNumber = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($accountNumber)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $accountNumber)) {
				$accountNumber = str_replace('*', '%', $accountNumber);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::ACCOUNT_NUMBER, $accountNumber, $comparison);
	}

	/**
	 * Filter the query on the holder_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHolderName('fooValue');   // WHERE holder_name = 'fooValue'
	 * $query->filterByHolderName('%fooValue%'); // WHERE holder_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $holderName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByHolderName($holderName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($holderName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $holderName)) {
				$holderName = str_replace('*', '%', $holderName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::HOLDER_NAME, $holderName, $comparison);
	}

	/**
	 * Filter the query on the account_type column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAccountType(1234); // WHERE account_type = 1234
	 * $query->filterByAccountType(array(12, 34)); // WHERE account_type IN (12, 34)
	 * $query->filterByAccountType(array('min' => 12)); // WHERE account_type > 12
	 * </code>
	 *
	 * @param     mixed $accountType The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByAccountType($accountType = null, $comparison = null)
	{
		if (is_array($accountType)) {
			$useMinMax = false;
			if (isset($accountType['min'])) {
				$this->addUsingAlias(PaymentInfoPeer::ACCOUNT_TYPE, $accountType['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($accountType['max'])) {
				$this->addUsingAlias(PaymentInfoPeer::ACCOUNT_TYPE, $accountType['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::ACCOUNT_TYPE, $accountType, $comparison);
	}

	/**
	 * Filter the query on the pdate column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPdate(1234); // WHERE pdate = 1234
	 * $query->filterByPdate(array(12, 34)); // WHERE pdate IN (12, 34)
	 * $query->filterByPdate(array('min' => 12)); // WHERE pdate > 12
	 * </code>
	 *
	 * @param     mixed $pdate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(PaymentInfoPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(PaymentInfoPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::PDATE, $pdate, $comparison);
	}
	/**
	 * Filter the query on the mail_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMailName('fooValue');   // WHERE mail_name = 'fooValue'
	 * $query->filterByMailName('%fooValue%'); // WHERE mail_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $mailName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByMailName($mailName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($mailName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $mailName)) {
				$mailName = str_replace('*', '%', $mailName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::MAIL_NAME, $mailName, $comparison);
	}

	/**
	 * Filter the query on the mail_add1 column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMailAdd1('fooValue');   // WHERE mail_add1 = 'fooValue'
	 * $query->filterByMailAdd1('%fooValue%'); // WHERE mail_add1 LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $mailAdd1 The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByMailAdd1($mailAdd1 = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($mailAdd1)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $mailAdd1)) {
				$mailAdd1 = str_replace('*', '%', $mailAdd1);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::MAIL_ADD1, $mailAdd1, $comparison);
	}

	/**
	 * Filter the query on the mail_add2 column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMailAdd2('fooValue');   // WHERE mail_add2 = 'fooValue'
	 * $query->filterByMailAdd2('%fooValue%'); // WHERE mail_add2 LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $mailAdd2 The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByMailAdd2($mailAdd2 = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($mailAdd2)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $mailAdd2)) {
				$mailAdd2 = str_replace('*', '%', $mailAdd2);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::MAIL_ADD2, $mailAdd2, $comparison);
	}

	/**
	 * Filter the query on the mail_city column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMailCity('fooValue');   // WHERE mail_city = 'fooValue'
	 * $query->filterByMailCity('%fooValue%'); // WHERE mail_city LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $mailCity The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByMailCity($mailCity = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($mailCity)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $mailCity)) {
				$mailCity = str_replace('*', '%', $mailCity);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::MAIL_CITY, $mailCity, $comparison);
	}

	/**
	 * Filter the query on the mail_state column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMailState('fooValue');   // WHERE mail_state = 'fooValue'
	 * $query->filterByMailState('%fooValue%'); // WHERE mail_state LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $mailState The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByMailState($mailState = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($mailState)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $mailState)) {
				$mailState = str_replace('*', '%', $mailState);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::MAIL_STATE, $mailState, $comparison);
	}

	/**
	 * Filter the query on the mail_zip column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMailZip('fooValue');   // WHERE mail_zip = 'fooValue'
	 * $query->filterByMailZip('%fooValue%'); // WHERE mail_zip LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $mailZip The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByMailZip($mailZip = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($mailZip)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $mailZip)) {
				$mailZip = str_replace('*', '%', $mailZip);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::MAIL_ZIP, $mailZip, $comparison);
	}

	/**
	 * Filter the query on the paypal_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPaypalId('fooValue');   // WHERE paypal_id = 'fooValue'
	 * $query->filterByPaypalId('%fooValue%'); // WHERE paypal_id LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $paypalId The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByPaypalId($paypalId = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($paypalId)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $paypalId)) {
				$paypalId = str_replace('*', '%', $paypalId);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::PAYPAL_ID, $paypalId, $comparison);
	}

	/**
	 * Filter the query on the paypal_approval_key column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPaypalApprovalKey('fooValue');   // WHERE paypal_approval_key = 'fooValue'
	 * $query->filterByPaypalApprovalKey('%fooValue%'); // WHERE paypal_approval_key LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $paypalApprovalKey The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByPaypalApprovalKey($paypalApprovalKey = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($paypalApprovalKey)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $paypalApprovalKey)) {
				$paypalApprovalKey = str_replace('*', '%', $paypalApprovalKey);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::PAYPAL_APPROVAL_KEY, $paypalApprovalKey, $comparison);
	}

	/**
	 * Filter the query on the paypal_info column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPaypalInfo('fooValue');   // WHERE paypal_info = 'fooValue'
	 * $query->filterByPaypalInfo('%fooValue%'); // WHERE paypal_info LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $paypalInfo The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByPaypalInfo($paypalInfo = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($paypalInfo)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $paypalInfo)) {
				$paypalInfo = str_replace('*', '%', $paypalInfo);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PaymentInfoPeer::PAYPAL_INFO, $paypalInfo, $comparison);
	}


	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(PaymentInfoPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(PaymentInfoPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the User relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('User');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'User');
		}

		return $this;
	}

	/**
	 * Use the User relation User object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
	}

	/**
	 * Filter the query by a related Payout object
	 *
	 * @param     Payout $payout  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function filterByPayout($payout, $comparison = null)
	{
		if ($payout instanceof Payout) {
			return $this
				->addUsingAlias(PaymentInfoPeer::ID, $payout->getPaymentInfoId(), $comparison);
		} elseif ($payout instanceof PropelCollection) {
			return $this
				->usePayoutQuery()
				->filterByPrimaryKeys($payout->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByPayout() only accepts arguments of type Payout or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Payout relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function joinPayout($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Payout');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Payout');
		}

		return $this;
	}

	/**
	 * Use the Payout relation Payout object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PayoutQuery A secondary query class using the current class as primary query
	 */
	public function usePayoutQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPayout($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Payout', 'PayoutQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     PaymentInfo $paymentInfo Object to remove from the list of results
	 *
	 * @return    PaymentInfoQuery The current query, for fluid interface
	 */
	public function prune($paymentInfo = null)
	{
		if ($paymentInfo) {
			$this->addUsingAlias(PaymentInfoPeer::ID, $paymentInfo->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BasePaymentInfoQuery